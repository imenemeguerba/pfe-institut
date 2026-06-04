<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Institut;
use App\Models\Produit;
use App\Models\Service;
use App\Models\User;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        $institut = Institut::instance();

        // Services actifs (6 max pour la landing)
        $services = Service::where('actif', true)
            ->with('category')
            ->take(6)
            ->get();

        // Nombre total de services actifs (pour les stats)
        $nbServices = Service::where('actif', true)->count();

        // Produits actifs (4 max)
        $produits = Produit::where('actif', true)
            ->where('stock', '>', 0)
            ->take(4)
            ->get();

        // Avis publiés sur l'institut
        $avis = Avis::with('client')
            ->where('type', 'institut')
            ->where('statut', 'publie')
            ->latest()
            ->take(6)
            ->get();

        $noteMoyenne = $avis->avg('note') ?? 0;

        // Nombre d'esthéticiennes actives
        $nbEsthes = User::where('role', 'estheticienne')
            ->where('statut_compte', 'actif')
            ->count();


// Affluence
$affluence = null;
if (auth()->check() && auth()->user()->isClient()) {
    $rdvAujourdhui = \App\Models\RendezVous::whereDate('date_debut', today())
        ->whereIn('statut', ['confirme', 'en_cours'])
        ->count();

    if ($rdvAujourdhui <= 3)      $affluence = ['niveau' => 'faible',  'message' => 'Great time to visit!'];
    elseif ($rdvAujourdhui <= 7)  $affluence = ['niveau' => 'moyen',   'message' => 'Moderately busy today.'];
    else                          $affluence = ['niveau' => 'eleve',   'message' => 'Very busy today, book in advance.'];
}



       return view('landingpage', compact(
    'institut', 'services', 'nbServices', 'produits', 'avis', 'noteMoyenne', 'nbEsthes', 'affluence'
));

    }
}
