<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CategorieProduit;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProduitController extends Controller
{
    public function index(Request $request): View
    {
        $search      = $request->query('search', '');
        $categorieId = $request->query('categorie');
        $prixMax     = $request->query('prix_max');
        $tri         = $request->query('tri', 'nom');

        $query = Produit::with('categorie')
            ->where('actif', true)
            ->where('stock', '>', 0);

        if ($search)      $query->where('nom', 'like', "%$search%");
        if ($categorieId) $query->where('categorie_id', $categorieId);
        if ($prixMax)     $query->where('prix', '<=', (int) $prixMax);

        match ($tri) {
            'prix_asc'  => $query->orderBy('prix'),
            'prix_desc' => $query->orderByDesc('prix'),
            default     => $query->orderBy('nom'),
        };

        $produits    = $query->paginate(12)->withQueryString();
        $categories  = CategorieProduit::where('actif', true)->orderBy('nom')->get();

        // IDs favoris du client
        $favorisIds = $request->user()->produitsFavoris()->pluck('produits.id')->toArray();

        // Nb articles dans panier
        $panier         = $request->user()->panier()->with('produits')->first();
        $panierProduits = $panier ? $panier->produits->pluck('pivot.quantite', 'id')->toArray() : [];

        return view('client.produits.index', compact(
            'produits', 'categories', 'search', 'categorieId', 'prixMax', 'tri',
            'favorisIds', 'panierProduits'
        ));
    }

    public function show(Request $request, Produit $produit): View
    {
        abort_if(!$produit->actif || $produit->stock <= 0, 404);
        $produit->load('categorie');

        $estFavori   = $request->user()->produitsFavoris()->where('produits.id', $produit->id)->exists();
        $panier      = $request->user()->panier()->with('produits')->first();
        $qteEnPanier = $panier ? ($panier->produits->find($produit->id)?->pivot->quantite ?? 0) : 0;

        return view('client.produits.show', compact('produit', 'estFavori', 'qteEnPanier'));
    }
}
