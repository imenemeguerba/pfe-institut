<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategorieProduit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategorieProduitController extends Controller
{
    public function index(): View
    {
        $categories = CategorieProduit::withCount('produits')->orderBy('nom')->get();
        return view('admin.categories-produits.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories-produits.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom'         => ['required', 'string', 'max:100', 'unique:categories_produits,nom'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        CategorieProduit::create([
            'nom'         => $request->nom,
            'description' => $request->description,
            'actif'       => $request->has('actif'),
        ]);

        return redirect()->route('admin.categories-produits.index')
            ->with('success', 'Product category created successfully.');
    }

    public function edit(CategorieProduit $categorieProduit): View
    {
        return view('admin.categories-produits.edit', compact('categorieProduit'));
    }

    public function update(Request $request, CategorieProduit $categorieProduit): RedirectResponse
    {
        $request->validate([
            'nom'         => ['required', 'string', 'max:100', 'unique:categories_produits,nom,' . $categorieProduit->id],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $categorieProduit->update([
            'nom'         => $request->nom,
            'description' => $request->description,
            'actif'       => $request->has('actif'),
        ]);

        return redirect()->route('admin.categories-produits.index')
            ->with('success', 'Product category updated successfully.');
    }

    public function toggle(CategorieProduit $categorieProduit): RedirectResponse
    {
        $categorieProduit->update(['actif' => !$categorieProduit->actif]);
        $status = $categorieProduit->actif ? 'activated' : 'deactivated';
        return back()->with('success', "Category {$status}.");
    }

    public function destroy(CategorieProduit $categorieProduit): RedirectResponse
    {
        if ($categorieProduit->produits()->count() > 0) {
            return back()->with('error', 'Cannot delete — this category contains products.');
        }
        $categorieProduit->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
