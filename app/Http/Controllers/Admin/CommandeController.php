<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CommandeConfirmeeClient;
use App\Mail\CommandeAnnuleeClient;
use App\Models\Commande;
use App\Services\FactureService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CommandeController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search', '');
        $statut = $request->query('statut', '');
        $filtre = $request->query('filtre', 'tous');

        $query = Commande::with(['client', 'produits'])->orderByDesc('created_at');

        if ($filtre === 'en_attente')  $query->where('statut', 'en_attente');
        elseif ($filtre === 'confirmees') $query->where('statut', 'confirmee');
        elseif ($filtre === 'annulees')   $query->where('statut', 'annulee');

        if ($statut) $query->where('statut', $statut);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('numero', 'like', "%$search%")
                  ->orWhereHas('client', fn($q2) =>
                      $q2->where('prenom', 'like', "%$search%")
                         ->orWhere('nom', 'like', "%$search%")
                         ->orWhere('email', 'like', "%$search%")
                  )->orWhereHas('produits', fn($q2) =>
                      $q2->where('nom', 'like', "%$search%")
                  );
            });
        }

        $commandes = $query->paginate(15)->withQueryString();

        $counts = [
            'tous'       => Commande::count(),
            'en_attente' => Commande::where('statut', 'en_attente')->count(),
            'confirmees' => Commande::where('statut', 'confirmee')->count(),
            'annulees'   => Commande::where('statut', 'annulee')->count(),
        ];

        return view('admin.commandes.index', compact('commandes', 'search', 'statut', 'filtre', 'counts'));
    }

    public function show(Commande $commande): View
    {
        $commande->load(['client', 'produits', 'codePromo', 'facture']);
        return view('admin.commandes.show', compact('commande'));
    }

    public function confirmer(Request $request, Commande $commande): RedirectResponse
    {
        if ($commande->statut !== 'en_attente') {
            return back()->with('error', 'This order can no longer be confirmed.');
        }

        DB::transaction(function () use ($commande) {

            // Décrémente le stock
            foreach ($commande->produits as $produit) {
                $qte = $produit->pivot->quantite;
                if ($produit->stock < $qte) {
                    throw new \Exception("Insufficient stock for: {$produit->nom}");
                }
                $produit->decrement('stock', $qte);
            }

            $commande->update([
                'statut'            => 'confirmee',
                'date_confirmation' => now(),
            ]);

            // Générer la facture
            FactureService::genererPourCommande($commande);
            $commande->load(['client', 'produits', 'codePromo', 'facture']);

            // ── Email commande confirmée + facture ──────────────────────
            try {
                Mail::to($commande->client->email)->send(new CommandeConfirmeeClient(
                    commande:      $commande,
                    facturePath:   $commande->facture?->chemin_pdf,
                    factureNumero: $commande->facture?->numero,
                ));
            } catch (\Exception $e) {
                \Log::error('Email commande confirmée: ' . $e->getMessage());
            }

            // ── Notification in-app ─────────────────────────────────────
            try {
                $commande->client->notifications()->create([
                    'id'      => \Illuminate\Support\Str::uuid(),
                    'type'    => 'commande_confirmee',
                    'data'    => json_encode([
                        'message' => "✅ Your order {$commande->numero} has been confirmed. Your invoice is available.",
                    ]),
                    'read_at' => null,
                ]);
            } catch (\Exception $e) {
                \Log::error('Notification commande confirmée: ' . $e->getMessage());
            }

            // ── Points fidélité ─────────────────────────────────────────
            try {
                \App\Services\FideliteService::ajouterPourCommande($commande->client, $commande);
            } catch (\Exception $e) {
                \Log::error('Fidélité commande: ' . $e->getMessage());
            }
        });

        return back()->with('success', "Order {$commande->numero} confirmed. Stock updated and invoice generated.");
    }

    public function annuler(Request $request, Commande $commande): RedirectResponse
    {
        $request->validate([
            'motif_annulation' => ['nullable', 'string', 'max:500'],
        ]);

        if ($commande->statut !== 'en_attente') {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }

        $commande->update([
            'statut'           => 'annulee',
            'date_annulation'  => now(),
            'motif_annulation' => $request->motif_annulation,
        ]);

        // ── Email au client ─────────────────────────────────────────────
        try {
            Mail::to($commande->client->email)->send(new CommandeAnnuleeClient($commande));
        } catch (\Exception $e) {
            \Log::error('Email commande annulée: ' . $e->getMessage());
        }

        // ── Notification in-app ─────────────────────────────────────────
        try {
            $commande->client->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'commande_annulee',
                'data'    => json_encode([
                    'message' => "❌ Your order {$commande->numero} has been cancelled." .
                                 ($request->motif_annulation ? " Reason: {$request->motif_annulation}" : ''),
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Notification commande annulée: ' . $e->getMessage());
        }

        return back()->with('success', "Order {$commande->numero} cancelled.");
    }
}
