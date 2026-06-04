<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $estheticienne = $request->user();

        $stats = [
            'rdv_aujourdhui' => $estheticienne->rendezVousAssignes()
                ->whereDate('date_debut', today())
                ->whereIn('statut', ['confirme', 'en_attente'])
                ->count(),

            'rdv_a_traiter' => $estheticienne->rendezVousAssignes()
                ->where('statut', 'en_attente')
                ->count(),

            'rdv_du_mois' => $estheticienne->rendezVousAssignes()
                ->whereMonth('date_debut', now()->month)
                ->whereYear('date_debut', now()->year)
                ->where('statut', 'termine')
                ->count(),

            'avis_recus' => Avis::where('estheticienne_id', $estheticienne->id)
                ->where('statut', 'publie')
                ->count(),

            'note_moyenne' => Avis::where('estheticienne_id', $estheticienne->id)
                ->where('statut', 'publie')
                ->avg('note') ?? 0,

            'nb_disponibilites'   => $estheticienne->disponibilites()->count(),
            'nb_absences_a_venir' => $estheticienne->indisponibilites()
                ->where('date_fin', '>=', now())
                ->count(),
        ];

        $rdvAVenir = $estheticienne->rendezVousAssignes()
            ->with(['client', 'services'])
            ->where('date_debut', '>=', now())
            ->whereIn('statut', ['confirme', 'en_attente'])
            ->orderBy('date_debut')
            ->take(5)
            ->get();

        return view('estheticienne.dashboard', compact('stats', 'rdvAVenir'));
    }
    public function welcome()
{
    $nbRdvAujourdhui = auth()->user()->rendezVousAssignes()
                        ->whereDate('date_debut', today())
                        ->count();

    $nbEnAttente = auth()->user()->rendezVousAssignes()
                    ->where('statut', 'en_attente')
                    ->count();

    return view('estheticienne.welcome', compact(
        'nbRdvAujourdhui',
        'nbEnAttente'
    ));
}
}
