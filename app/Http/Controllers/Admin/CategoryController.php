<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Affiche la liste de toutes les catégories.
     */
    public function index(\Illuminate\Http\Request $request): View
    {
        $search = $request->query('search', '');

        $query = Category::withCount('services')->orderBy('nom');

        if ($search) {
            $query->where('nom', 'like', '%' . $search . '%');
        }

        $categories = $query->paginate(15)->withQueryString();

        return view('admin.categories.index', compact('categories', 'search'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Enregistre une nouvelle catégorie.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Met à jour une catégorie.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        // Gestion de l'image (remplacement)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    /**
     * Supprime une catégorie.
     */
    public function destroy(Category $category): RedirectResponse
    {
        // Vérifier s'il y a des services liés
        if ($category->services()->count() > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie : elle contient des services. Désactivez-la plutôt.');
        }

        // Supprimer l'image associée
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }

    /**
     * Active ou désactive rapidement une catégorie (toggle).
     */
    public function toggleActif(Category $category): RedirectResponse
    {
        $category->update(['actif' => !$category->actif]);

        $status = $category->actif ? 'activée' : 'désactivée';

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Catégorie {$status} avec succès.");
    }
    public function toggle(\App\Models\Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->update(['actif' => !$category->actif]);
        return back()->with('success', 'Statut de la catégorie mis à jour.');
    }
}
