<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use App\Models\Institut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanningController extends Controller
{
    public function index(Request $request): View
    {
        $estheticienne = $request->user();

        $semaineOffset = (int) $request->query('semaine', 0);
        $lundi      = Carbon::now()->startOfWeek()->addWeeks($semaineOffset);
        $finSemaine = $lundi->copy()->addDays(7);

        $datesSemaine = [];
        for ($i = 0; $i < 7; $i++) {
            $datesSemaine[$i + 1] = $lundi->copy()->addDays($i);
        }

        $disponibilites = $estheticienne->disponibilites()
            ->orderBy('jour_semaine')
            ->orderBy('heure_debut')
            ->get()
            ->groupBy('jour_semaine');

        $indisponibilitesSemaine = $estheticienne->indisponibilites()
            ->where('date_debut', '<', $finSemaine)
            ->where('date_fin', '>=', $lundi)
            ->get();

        $indisponibilites = $estheticienne->indisponibilites()
            ->where('date_fin', '>=', now())
            ->orderBy('date_debut')
            ->get();

        // ── RDV de la semaine — TOUS les statuts ─────────────────────────
        $rdvsSemaine = $estheticienne->rendezVousAssignes()
            ->with(['client', 'services'])
            ->where('date_debut', '<', $finSemaine)
            ->where('date_fin',   '>', $lundi)
            ->whereIn('statut', ['confirme', 'en_attente', 'termine', 'annule', 'refuse', 'reporte'])
            ->orderBy('date_debut')
            ->get();

        $institut         = Institut::instance();
        $horairesInstitut = $institut->horaires_ouverture ?? [];
        $heures           = range(8, 19);

        return view('estheticienne.planning.index', compact(
            'estheticienne',
            'disponibilites',
            'indisponibilites',
            'indisponibilitesSemaine',
            'rdvsSemaine',
            'horairesInstitut',
            'heures',
            'datesSemaine',
            'lundi',
            'semaineOffset'
        ));
    }
}
