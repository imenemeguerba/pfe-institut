<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Affiche le dashboard esthéticienne avec ses indicateurs.
     */
    public function index(Request $request): View
    {
        $estheticienne = $request->user();

        $stats = [
            'rdv_aujourdhui' => $estheticienne->rendezVousAssignes()
                ->whereDate('date_debut', today())
                ->confirmes()
                ->count(),

            'rdv_a_traiter' => $estheticienne->rendezVousAssignes()
                ->statut('en_attente')
                ->count(),

            'rdv_du_mois' => $estheticienne->rendezVousAssignes()
                ->whereMonth('date_debut', now()->month)
                ->whereYear('date_debut', now()->year)
                ->statut('termine')
                ->count(),

            'avis_recus' => $estheticienne->avisRecus()
                ->publies()
                ->count(),

            'note_moyenne' => $estheticienne->avisRecus()
                ->publies()
                ->avg('note') ?? 0,
        ];

        return view('estheticienne.dashboard', compact('stats'));
    }
}
