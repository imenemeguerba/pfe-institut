<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PerformanceController extends Controller
{
    public function index(Request $request): View
    {
        $esthe = $request->user();

        // Stats globales
        $stats = [
            'total_rdv_termines'  => $esthe->rendezVousAssignes()->where('statut', 'termine')->count(),
            'rdv_ce_mois'         => $esthe->rendezVousAssignes()
                ->where('statut', 'termine')
                ->whereMonth('date_debut', now()->month)
                ->whereYear('date_debut', now()->year)
                ->count(),
            'note_moyenne'        => Avis::where('estheticienne_id', $esthe->id)->where('statut', 'publie')->avg('note') ?? 0,
            'total_avis'          => Avis::where('estheticienne_id', $esthe->id)->where('statut', 'publie')->count(),
        ];

        // Activité par mois (6 derniers mois)
        $activiteMois = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $activiteMois->push([
                'mois'  => $date->isoFormat('MMM YYYY'),
                'count' => $esthe->rendezVousAssignes()
                    ->where('statut', 'termine')
                    ->whereMonth('date_debut', $date->month)
                    ->whereYear('date_debut', $date->year)
                    ->count(),
            ]);
        }

        // Avis publiés
        $avis = Avis::where('estheticienne_id', $esthe->id)
            ->where('statut', 'publie')
            ->with(['client', 'rendezVous'])
            ->orderByDesc('created_at')
            ->paginate(10);

        // Historique RDV terminés
        $rdvTermines = $esthe->rendezVousAssignes()
            ->with(['client', 'services'])
            ->where('statut', 'termine')
            ->orderByDesc('date_debut')
            ->paginate(10, ['*'], 'rdv_page');

        return view('estheticienne.performance.index', compact(
            'stats', 'activiteMois', 'avis', 'rdvTermines'
        ));
    }
}
