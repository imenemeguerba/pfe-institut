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
            ->with('success', 'Catégorie créée avec succès.');
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
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    public function toggle(CategorieProduit $categorieProduit): RedirectResponse
    {
        $categorieProduit->update(['actif' => !$categorieProduit->actif]);
        $status = $categorieProduit->actif ? 'activée' : 'désactivée';
        return back()->with('success', "Catégorie {$status}.");
    }

    public function destroy(CategorieProduit $categorieProduit): RedirectResponse
    {
        if ($categorieProduit->produits()->count() > 0) {
            return back()->with('error', 'Impossible — cette catégorie contient des produits.');
        }
        $categorieProduit->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }
}
