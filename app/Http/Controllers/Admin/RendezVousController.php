<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institut;
use App\Models\RendezVous;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RendezVousController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────
    // Liste de tous les RDV avec recherche
    // ─────────────────────────────────────────────────────────────────────
    public function index(Request $request): View
    {
        $search  = $request->query('search', '');
        $statut  = $request->query('statut', '');
        $filtre  = $request->query('filtre', 'tous');

        $query = RendezVous::with(['client', 'estheticienne', 'services'])
            ->orderByDesc('date_debut');

        // Filtre période
        if ($filtre === 'a_venir') {
            $query->where('date_debut', '>=', now())
                  ->whereIn('statut', ['en_attente', 'confirme']);
        } elseif ($filtre === 'passes') {
            $query->where('date_debut', '<', now());
        } elseif ($filtre === 'aujourd_hui') {
            $query->whereDate('date_debut', today());
        }

        // Filtre statut
        if ($statut) {
            $query->where('statut', $statut);
        }

        // Recherche par client ou esthéticienne
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('client', fn($q2) =>
                    $q2->where('prenom', 'like', "%$search%")
                       ->orWhere('nom', 'like', "%$search%")
                       ->orWhere('email', 'like', "%$search%")
                )->orWhereHas('estheticienne', fn($q2) =>
                    $q2->where('prenom', 'like', "%$search%")
                       ->orWhere('nom', 'like', "%$search%")
                )->orWhereHas('services', fn($q2) =>
                    $q2->where('nom', 'like', "%$search%")
                );
            });
        }

        $rdvs = $query->paginate(15)->withQueryString();

        // Compteurs pour les onglets
        $counts = [
            'tous'        => RendezVous::count(),
            'a_venir'     => RendezVous::where('date_debut', '>=', now())->whereIn('statut', ['en_attente', 'confirme'])->count(),
            'aujourd_hui' => RendezVous::whereDate('date_debut', today())->count(),
            'passes'      => RendezVous::where('date_debut', '<', now())->count(),
        ];

        return view('admin.rendez-vous.index', compact('rdvs', 'search', 'statut', 'filtre', 'counts'));
    }

    // ─────────────────────────────────────────────────────────────────────
    // Détails d'un RDV
    // ─────────────────────────────────────────────────────────────────────
    public function show(RendezVous $rendezVous): View
    {
        $rendezVous->load(['client', 'estheticienne', 'services', 'codePromo']);

        // Si RDV groupé, charger les autres
        $rdvsGroupe = null;
        if ($rendezVous->groupe_reservation) {
            $rdvsGroupe = RendezVous::where('groupe_reservation', $rendezVous->groupe_reservation)
                ->where('id', '!=', $rendezVous->id)
                ->with(['estheticienne', 'services', 'client'])
                ->get();
        }

        return view('admin.rendez-vous.show', compact('rendezVous', 'rdvsGroupe'));
    }

    // ─────────────────────────────────────────────────────────────────────
    // Calendrier global de toutes les esthéticiennes
    // ─────────────────────────────────────────────────────────────────────
    public function calendrier(Request $request): View
    {
        $semaineOffset = (int) $request->query('semaine', 0);
        $lundi         = Carbon::now()->startOfWeek()->addWeeks($semaineOffset);
        $finSemaine    = $lundi->copy()->addDays(7);

        $datesSemaine = [];
        for ($i = 0; $i < 7; $i++) {
            $datesSemaine[$i + 1] = $lundi->copy()->addDays($i);
        }

        // Toutes les esthéticiennes actives
        $estheticiennes = User::where('role', 'estheticienne')
            ->where('statut_compte', 'actif')
            ->orderBy('prenom')
            ->get();

        // Filtre par esthéticienne
        $estheId = $request->query('estheticienne_id');
        if ($estheId) {
            $estheticiennes = $estheticiennes->where('id', $estheId)->values();
        }

        // RDV de la semaine pour toutes les esthéticiennes
        $rdvsSemaine = RendezVous::with(['client', 'services', 'estheticienne'])
            ->where('date_debut', '<', $finSemaine)
            ->where('date_fin', '>', $lundi)
            ->whereIn('statut', ['en_attente', 'confirme', 'termine'])
            ->whereIn('estheticienne_id', $estheticiennes->pluck('id'))
            ->get()
            ->groupBy('estheticienne_id');

        // Disponibilités de toutes les esthéticiennes
        $disponibilites = [];
        $indisponibilites = [];
        foreach ($estheticiennes as $esthe) {
            $disponibilites[$esthe->id] = $esthe->disponibilites()
                ->orderBy('jour_semaine')->orderBy('heure_debut')->get()->groupBy('jour_semaine');

            $indisponibilites[$esthe->id] = $esthe->indisponibilites()
                ->where('date_debut', '<', $finSemaine)
                ->where('date_fin', '>=', $lundi)
                ->get();
        }

        $institut         = Institut::instance();
        $horairesInstitut = $institut->horaires_ouverture ?? [];
        $heures           = range(8, 19);

        // Liste pour le filtre
        $toutesEsthes = User::where('role', 'estheticienne')
            ->where('statut_compte', 'actif')
            ->orderBy('prenom')
            ->get();

        return view('admin.rendez-vous.calendrier', compact(
            'estheticiennes', 'rdvsSemaine', 'disponibilites', 'indisponibilites',
            'horairesInstitut', 'heures', 'datesSemaine', 'lundi',
            'semaineOffset', 'estheId', 'toutesEsthes'
        ));
    }
}
