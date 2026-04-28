<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Institut;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Affiche le dashboard client avec ses RDV à venir et stats.
     */
    public function index(Request $request): View
    {
        $client = $request->user();
        $institut = Institut::instance();

        $data = [
            'rdv_a_venir' => $client->rendezVous()
                ->avenir()
                ->confirmes()
                ->orderBy('date_debut')
                ->take(3)
                ->get(),

            'commandes_recentes' => $client->commandes()
                ->orderByDesc('created_at')
                ->take(3)
                ->get(),

            'affluence_aujourdhui' => $institut->calculerAffluence(),
            'couleur_affluence' => null, // Sera calculée dans la vue
        ];

        $data['couleur_affluence'] = $institut->couleurAffluence($data['affluence_aujourdhui']);

        return view('client.dashboard', compact('data'));
    }
}
