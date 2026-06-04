<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FavorisController extends Controller
{
    public function index(Request $request): View
    {
        $favoris = $request->user()->produitsFavoris()
            ->where('actif', true)
            ->orderBy('nom')
            ->get();

        return view('client.favoris.index', compact('favoris'));
    }

    public function toggle(Request $request, Produit $produit): RedirectResponse|\Illuminate\Http\JsonResponse
{
    $user = $request->user();
    $estFavori = $user->produitsFavoris()->where('produits.id', $produit->id)->exists();

    if ($estFavori) {
        $user->produitsFavoris()->detach($produit->id);
    } else {
        $user->produitsFavoris()->attach($produit->id);
    }

    // Si requête AJAX → JSON
    if ($request->expectsJson()) {
        return response()->json(['estFavori' => !$estFavori]);
    }

    $message = $estFavori
        ? "❤️ {$produit->nom} removed from wishlist."
        : "❤️ {$produit->nom} added to wishlist!";

    return back()->with('success', $message);
}
}
