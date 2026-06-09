<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProduitRequest;
use App\Models\CategorieProduit;
use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProduitController extends Controller
{
    public function index(Request $request): View
    {
        $search      = $request->query('search', '');
        $filtre      = $request->query('filtre', 'tous');
        $categorieId = $request->query('categorie_id');

        $query = Produit::with('categorie')->orderBy('nom');

        if ($filtre === 'actifs')         $query->where('actif', true);
        elseif ($filtre === 'inactifs')   $query->where('actif', false);
        elseif ($filtre === 'stock_critique') $query->whereColumn('stock', '<=', 'seuil_alerte');

        if ($search)      $query->where('nom', 'like', "%$search%");
        if ($categorieId) $query->where('categorie_id', $categorieId);

        $produits = $query->paginate(15)->withQueryString();

        $compteurs = [
            'tous'          => Produit::count(),
            'actifs'        => Produit::where('actif', true)->count(),
            'inactifs'      => Produit::where('actif', false)->count(),
            'stock_critique'=> Produit::whereColumn('stock', '<=', 'seuil_alerte')->count(),
        ];

        $categories = CategorieProduit::where('actif', true)->orderBy('nom')->get();

        return view('admin.produits.index', compact('produits', 'search', 'filtre', 'compteurs', 'categories'));
    }

    public function create(): View
    {
        $categories = CategorieProduit::where('actif', true)->orderBy('nom')->get();
        return view('admin.produits.create', compact('categories'));
    }

    public function store(ProduitRequest $request): RedirectResponse
    {
        $data = $request->validated();
$data['types_peau'] = $request->input('types_peau', []);

if ($request->hasFile('image')) {
    $data['image'] = $request->file('image')->store('produits', 'public');
}

        $produit = Produit::create($data);

if ($request->has('variantes')) {
    \App\Http\Controllers\Admin\VarianteController::syncProduit($produit, $request->variantes);
}


        return redirect()->route('admin.produits.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Produit $produit): View
    {
        $categories = CategorieProduit::where('actif', true)->orderBy('nom')->get();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    public function update(ProduitRequest $request, Produit $produit): RedirectResponse
    {
        $data = $request->validated();
$data['types_peau'] = $request->input('types_peau', []);

if ($request->hasFile('image')) {
            if ($produit->image) Storage::disk('public')->delete($produit->image);
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        $produit->update($data);
        if ($request->has('variantes')) {
    \App\Http\Controllers\Admin\VarianteController::syncProduit($produit, $request->variantes);
}

        return redirect()->route('admin.produits.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Produit $produit): RedirectResponse
    {
        $commandesCount = $produit->commandes()->count();
        if ($commandesCount > 0) {
            return back()->with('error', "Cannot delete — this product has been ordered {$commandesCount} time(s). Deactivate it instead.");
        }

        if ($produit->image) Storage::disk('public')->delete($produit->image);
        $produit->delete();

        return redirect()->route('admin.produits.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function toggle(Produit $produit): RedirectResponse
    {
        $produit->update(['actif' => !$produit->actif]);
        return back()->with('success', 'Product status updated.');
    }
}
