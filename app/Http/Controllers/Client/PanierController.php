<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Panier;
use App\Models\Produit;
use App\Models\ProduitVariante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PanierController extends Controller
{
    private function getPanier(int $clientId): Panier
    {
        return Panier::firstOrCreate(['client_id' => $clientId]);
    }

    public function index(Request $request): View
    {
        $panier = $this->getPanier($request->user()->id);
        $panier->load('produits');
        return view('client.panier.index', compact('panier'));
    }

    public function ajouter(Request $request, Produit $produit): RedirectResponse
    {
        if (!$produit->actif) {
            return back()->with('error', 'Ce produit n\'est pas disponible.');
        }

        $request->validate(['quantite' => ['nullable', 'integer', 'min:1', 'max:20']]);
        $qte        = (int) $request->input('quantite', 1);
        $varianteId = $request->input('variante_id') ?: null;
        $panier     = $this->getPanier($request->user()->id);
        $panier->load('produits');

        // ── Vérif stock selon variante ou produit ──
        if ($varianteId) {
            $variante = ProduitVariante::where('id', $varianteId)
                ->where('produit_id', $produit->id)
                ->firstOrFail();

            if ($variante->stock <= 0) {
                return back()->with('error', 'Stock insuffisant pour cette variante.');
            }

            // Chercher si déjà dans panier avec même variante
            $existing = $panier->produits()
                ->wherePivot('variante_id', $varianteId)
                ->find($produit->id);

            $newQte = ($existing ? $existing->pivot->quantite : 0) + $qte;

            if ($newQte > $variante->stock) {
                return back()->with('error', "Stock insuffisant. Maximum disponible : {$variante->stock}.");
            }

            if ($existing) {
                $panier->produits()->wherePivot('variante_id', $varianteId)
                    ->updateExistingPivot($produit->id, ['quantite' => $newQte]);
            } else {
                $panier->produits()->attach($produit->id, [
                    'quantite'    => $qte,
                    'variante_id' => $varianteId,
                ]);
            }

            return back()->with('success', "✅ {$produit->nom} ({$variante->nom}) ajouté au panier.");
        }

        // ── Sans variante ──
        if ($produit->stock <= 0) {
            return back()->with('error', 'Ce produit n\'est pas disponible.');
        }

        $existing = $panier->produits->find($produit->id);
        $newQte   = ($existing ? $existing->pivot->quantite : 0) + $qte;

        if ($newQte > $produit->stock) {
            return back()->with('error', "Stock insuffisant. Maximum disponible : {$produit->stock}.");
        }

        if ($existing) {
            $panier->produits()->updateExistingPivot($produit->id, ['quantite' => $newQte]);
        } else {
            $panier->produits()->attach($produit->id, ['quantite' => $qte]);
        }

        return back()->with('success', "✅ {$produit->nom} ajouté au panier.");
    }

    public function modifier(Request $request, Produit $produit): RedirectResponse
    {
        $request->validate(['quantite' => ['required', 'integer', 'min:0', 'max:20']]);
        $qte    = (int) $request->quantite;
        $panier = $this->getPanier($request->user()->id);

        if ($qte === 0) {
            $panier->produits()->detach($produit->id);
            return back()->with('success', 'Produit retiré du panier.');
        }

        if ($qte > $produit->stock) {
            return back()->with('error', "Stock insuffisant. Maximum : {$produit->stock}.");
        }

        $panier->produits()->syncWithoutDetaching([$produit->id => ['quantite' => $qte]]);
        return back()->with('success', 'Panier mis à jour.');
    }

    public function retirer(Request $request, Produit $produit): RedirectResponse
    {
        $panier = $this->getPanier($request->user()->id);
        $panier->produits()->detach($produit->id);
        return back()->with('success', 'Produit retiré du panier.');
    }

    public function vider(Request $request): RedirectResponse
    {
        $panier = $this->getPanier($request->user()->id);
        $panier->produits()->detach();
        return back()->with('success', 'Panier vidé.');
    }
}