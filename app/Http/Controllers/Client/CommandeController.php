<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CodePromo;
use App\Models\Commande;
use App\Services\FactureService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CommandeController extends Controller
{
    public function index(Request $request): View
    {
        $filtre = $request->query('filtre', 'toutes');
        $user   = $request->user();

        $query = $user->commandes()->with(['produits', 'facture'])->orderByDesc('created_at');

        if ($filtre === 'en_attente') $query->where('statut', 'en_attente');
        elseif ($filtre === 'confirmees') $query->where('statut', 'confirmee');
        elseif ($filtre === 'annulees') $query->where('statut', 'annulee');

        $commandes = $query->paginate(10)->withQueryString();

        return view('client.commandes.index', compact('commandes', 'filtre'));
    }

    public function show(Request $request, Commande $commande): View
    {
        if ($commande->client_id !== $request->user()->id) abort(403);
        $commande->load(['produits', 'codePromo', 'facture']);
        return view('client.commandes.show', compact('commande'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user   = $request->user();
        $panier = $user->panier()->with('produits')->first();

        if (!$panier || $panier->estVide()) {
            return redirect()->route('client.panier.index')
                ->with('error', 'Votre panier est vide.');
        }

        $produits     = $panier->produits;
        $prixOriginal = $produits->sum(fn($p) => $p->prix * $p->pivot->quantite);
        $prixFinal    = $prixOriginal;
        $codePromoId  = null;

        // Code promo
        if ($request->filled('code_promo')) {
            $code      = strtoupper(trim($request->code_promo));
            $codePromo = CodePromo::where('code', $code)->first();

            if (!$codePromo)
                return back()->withInput()->with('error', 'Code promo invalide.');

            $now = now();
            if (!$codePromo->actif || $codePromo->date_debut > $now || $codePromo->date_fin < $now)
                return back()->withInput()->with('error', 'Ce code promo n\'est pas valide actuellement.');

            if ($codePromo->limite_utilisation && $codePromo->nombre_utilisations >= $codePromo->limite_utilisation)
                return back()->withInput()->with('error', 'Ce code promo a atteint sa limite d\'utilisation.');

            if (!in_array($codePromo->applicable_a, ['produits', 'les_deux']))
                return back()->withInput()->with('error', 'Ce code promo n\'est pas applicable aux produits.');

            $reduction   = $codePromo->type_reduction === 'pourcentage'
                ? (int) round($prixOriginal * $codePromo->valeur / 100)
                : $codePromo->valeur;

            $prixFinal   = max(0, $prixOriginal - $reduction);
            $codePromoId = $codePromo->id;
            $codePromo->increment('nombre_utilisations');
        }

        // Vérifier stocks
        foreach ($produits as $produit) {
            if ($produit->stock < $produit->pivot->quantite) {
                return back()->with('error', "Stock insuffisant pour : {$produit->nom} (disponible: {$produit->stock}).");
            }
        }

        DB::transaction(function () use ($user, $produits, $prixOriginal, $prixFinal, $codePromoId, $panier) {
            $commande = Commande::create([
                'numero'       => FactureService::genererNumeroCommande(),
                'client_id'    => $user->id,
                'statut'       => 'en_attente',
                'prix_original' => $prixOriginal,
                'prix_final'   => $prixFinal,
                'code_promo_id' => $codePromoId,
            ]);

            foreach ($produits as $produit) {
                $commande->produits()->attach($produit->id, [
                    'quantite'       => $produit->pivot->quantite,
                    'prix_au_moment' => $produit->prix,
                ]);
            }

            // Vider le panier
            $panier->vider();

            // Notifier l'admin
            try {
                \App\Models\User::where('role', 'admin')->first()
                    ?->notifications()->create([
                      'id'      => \Illuminate\Support\Str::uuid(),
                      'type'    => 'nouvelle_commande',
                      'data'    => json_encode(['message' => "🛒 New order {$commande->numero} from {$user->fullName()}"]),
                      'read_at' => null,
                    ]);
            } catch (\Exception $e) {}
        });

        return redirect()->route('client.commandes.index')
            ->with('success', '✅ Commande passée ! Elle sera confirmée par notre équipe sous peu.');
    }

    public function annuler(Request $request, Commande $commande): RedirectResponse
    {
        if ($commande->client_id !== $request->user()->id) abort(403);

        if ($commande->statut !== 'en_attente') {
            return back()->with('error', 'Seules les commandes en attente peuvent être annulées.');
        }

        $commande->update([
            'statut'          => 'annulee',
            'date_annulation' => now(),
            'motif_annulation' => 'Annulée par le client',
        ]);

        return back()->with('success', 'Commande annulée.');
    }
}
