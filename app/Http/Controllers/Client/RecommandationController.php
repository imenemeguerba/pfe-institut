<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecommandationController extends Controller
{
    const TYPES_PEAU = [
        'normale'  => 'Peau normale',
        'grasse'   => 'Peau grasse',
        'seche'    => 'Peau sèche',
        'mixte'    => 'Peau mixte',
        'sensible' => 'Peau sensible',
    ];

    public function index(Request $request): View
    {
        $client   = $request->user();
        $typePeau = $client->type_peau;

        $servicesRecommandes = collect();
        $produitsRecommandes = collect();

        if ($typePeau) {
            // Services adaptés à ce type de peau (ou sans restriction)
            $servicesRecommandes = Service::where('actif', true)
                ->where(function ($q) use ($typePeau) {
                    $q->whereNull('types_peau')
                      ->orWhereJsonContains('types_peau', $typePeau);
                })
                ->with('category')
                ->get();

            // Produits adaptés à ce type de peau (ou sans restriction)
            $produitsRecommandes = Produit::where('actif', true)
                ->where('stock', '>', 0)
                ->where(function ($q) use ($typePeau) {
                    $q->whereNull('types_peau')
                      ->orWhereJsonContains('types_peau', $typePeau);
                })
                ->with('categorie')
                ->get();
        }

        return view('client.recommandations.index', compact(
            'client', 'typePeau', 'servicesRecommandes', 'produitsRecommandes'
        ));
    }

    public function updateTypePeau(Request $request): RedirectResponse
    {
        $request->validate([
            'type_peau' => ['required', 'in:normale,grasse,seche,mixte,sensible'],
        ]);

        $request->user()->update(['type_peau' => $request->type_peau]);

        return redirect()->route('client.recommandations.index')
            ->with('success', 'Votre type de peau a été mis à jour ! Voici vos recommandations personnalisées.');
    }
}
