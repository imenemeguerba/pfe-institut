<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\NouveauRdvEsthe;
use App\Models\Category;
use App\Models\CodePromo;
use App\Models\Institut;
use App\Models\RendezVous;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function create(Request $request): View|JsonResponse
    {
        $search     = $request->query('search', '');
        $categoryId = $request->query('categorie');
        $prixMax    = $request->query('prix_max');
        $dureeMax   = $request->query('duree_max');
        $estheticiennePreSelectionnee = $request->query('estheticienne') ? (int) $request->query('estheticienne') : null;

        $query = Service::with(['category', 'estheticiennes' => fn($q) => $q->where('statut_compte', 'actif')])
            ->where('actif', true)
            ->whereHas('estheticiennes', fn($q) => $q->where('statut_compte', 'actif'))
            ->orderBy('nom');

        if ($search)     $query->where('nom', 'like', "%$search%");
        if ($categoryId) $query->where('category_id', $categoryId);
        if ($prixMax)    $query->where('prix', '<=', (int) $prixMax);
        if ($dureeMax)   $query->where('duree', '<=', (int) $dureeMax);

        $services                = $query->get();
        $categories              = Category::where('actif', true)->orderBy('nom')->get();
        $servicesPreSelectionnes = $request->query('service') ? [(int) $request->query('service')] : [];

        if ($request->ajax() || $request->has('ajax')) {
            $html = view('client.reservation.partials.services-grid', compact(
                'services', 'servicesPreSelectionnes'
            ))->render();
            return response()->json(['html' => $html]);
        }

        return view('client.reservation.create', compact(
            'services', 'categories', 'search',
            'categoryId', 'prixMax', 'dureeMax', 'servicesPreSelectionnes', 'estheticiennePreSelectionnee'
        ));
    }

    public function esthesCompetentes(Request $request): JsonResponse
    {
        $request->validate([
            'service_ids'   => ['required', 'array', 'min:1'],
            'service_ids.*' => ['integer', 'exists:services,id'],
        ]);

        $serviceIds = $request->input('service_ids');
        $services   = Service::whereIn('id', $serviceIds)->where('actif', true)->get();

        if ($services->count() !== count($serviceIds)) {
            return response()->json(['error' => 'Invalid service'], 404);
        }

        $dureeTotale = $services->sum('duree');
        $prixTotal   = $services->sum('prix');

        $esthesCompletes = User::where('role', 'estheticienne')
            ->where('statut_compte', 'actif')
            ->whereHas('servicesProposes', fn($q) => $q->whereIn('services.id', $serviceIds), '=', count($serviceIds))
            ->get();

        if ($esthesCompletes->isNotEmpty()) {
            return response()->json([
                'mode'         => 'simple',
                'esthes'       => $esthesCompletes->map(fn($e) => [
                    'id'          => $e->id,
                    'nom'         => $e->fullName(),
                    'experience'  => $e->experience,
                    'specialites' => $e->specialites,
                ])->values(),
                'duree_totale' => $dureeTotale,
                'prix_total'   => $prixTotal,
            ]);
        }

        $groupes = $this->grouperServicesParEsthe($services);

        if (empty($groupes)) {
            return response()->json([
                'mode'  => 'impossible',
                'error' => 'Some services have no available expert.',
            ]);
        }

        return response()->json([
            'mode'         => 'split',
            'groupes'      => $groupes,
            'duree_totale' => $dureeTotale,
            'prix_total'   => $prixTotal,
        ]);
    }

    protected function grouperServicesParEsthe($services): array
    {
        $serviceEstheMap = [];

        foreach ($services as $service) {
            $esthes = User::where('role', 'estheticienne')
                ->where('statut_compte', 'actif')
                ->whereHas('servicesProposes', fn($q) => $q->where('services.id', $service->id))
                ->get();

            if ($esthes->isEmpty()) return [];

            $serviceEstheMap[$service->id] = [
                'service' => $service,
                'esthes'  => $esthes,
            ];
        }

        uasort($serviceEstheMap, fn($a, $b) => $a['esthes']->count() <=> $b['esthes']->count());

        $groupes  = [];
        $assignes = [];

        foreach ($serviceEstheMap as $serviceId => $data) {
            if (in_array($serviceId, $assignes)) continue;

            $assigneAGroupe = false;

            foreach ($groupes as &$groupe) {
                foreach ($data['esthes'] as $esthe) {
                    if ($esthe->id === $groupe['esthe']->id) {
                        $groupe['services'][] = $data['service'];
                        $groupe['duree']     += $data['service']->duree;
                        $groupe['prix']      += $data['service']->prix;
                        $assignes[]           = $serviceId;
                        $assigneAGroupe       = true;
                        break 2;
                    }
                }
            }
            unset($groupe);

            if (!$assigneAGroupe) {
                $groupes[]  = [
                    'esthe'    => $data['esthes']->first(),
                    'services' => [$data['service']],
                    'duree'    => $data['service']->duree,
                    'prix'     => $data['service']->prix,
                ];
                $assignes[] = $serviceId;
            }
        }

        return array_map(fn($g) => [
            'esthe'    => ['id' => $g['esthe']->id, 'nom' => $g['esthe']->fullName()],
            'services' => array_map(fn($s) => ['id' => $s->id, 'nom' => $s->nom], $g['services']),
            'duree'    => $g['duree'],
            'prix'     => $g['prix'],
        ], $groupes);
    }

    public function creneaux(Request $request): JsonResponse
    {
        $request->validate([
            'service_ids'      => ['required', 'array', 'min:1'],
            'service_ids.*'    => ['integer', 'exists:services,id'],
            'estheticienne_id' => ['nullable', 'integer', 'exists:users,id'],
            'mode'             => ['nullable', 'in:simple,split'],
        ]);

        $mode       = $request->input('mode', 'simple');
        $serviceIds = $request->input('service_ids');
        $services   = Service::whereIn('id', $serviceIds)->where('actif', true)->get();

        if ($services->count() !== count($serviceIds)) {
            return response()->json(['error' => 'Invalid service'], 404);
        }

        if ($mode === 'split') {
            $splitGroupes = $request->input('split_groupes', []);

            if (empty($splitGroupes)) {
                return response()->json(['error' => 'Missing groups'], 422);
            }

            $groupesData = [];
            foreach ($splitGroupes as $g) {
                $esthe = User::find($g['esthe_id']);
                if (!$esthe) continue;
                $groupesData[] = ['esthe' => $esthe, 'duree' => (int) $g['duree']];
            }

            $dureeTotale = array_sum(array_column($groupesData, 'duree'));
            $jours       = [];
            $aujourdhui  = Carbon::today();

            for ($i = 0; $i < 15; $i++) {
                $date     = $aujourdhui->copy()->addDays($i);
                $creneaux = $this->calculerCreneauxDisponiblesSplit($groupesData, $date);
                if (!empty($creneaux)) {
                    $jours[] = [
                        'date'        => $date->toDateString(),
                        'date_label'  => $date->isoFormat('dddd D MMMM'),
                        'is_today'    => $date->isToday(),
                        'is_tomorrow' => $date->isTomorrow(),
                        'creneaux'    => $creneaux,
                    ];
                }
            }

            return response()->json(['jours' => $jours, 'duree_totale' => $dureeTotale]);
        }

        $dureeTotale     = $services->sum('duree');
        $estheticienneId = $request->input('estheticienne_id');

        if ($estheticienneId) {
            $estheticienne = User::find($estheticienneId);
            if (!$estheticienne || !$estheticienne->isEstheticienne() || !$estheticienne->estActif()) {
                return response()->json(['error' => 'Invalid expert'], 404);
            }
            $esthes = collect([$estheticienne]);
        } else {
            $esthes = User::where('role', 'estheticienne')
                ->where('statut_compte', 'actif')
                ->whereHas('servicesProposes', fn($q) => $q->whereIn('services.id', $serviceIds), '=', count($serviceIds))
                ->get();
        }

        $jours      = [];
        $aujourdhui = Carbon::today();

        for ($i = 0; $i < 15; $i++) {
            $date     = $aujourdhui->copy()->addDays($i);
            $creneaux = [];
            foreach ($esthes as $esthe) {
                $c        = $this->calculerCreneauxDisponibles($esthe, $dureeTotale, $date);
                $creneaux = array_merge($creneaux, $c);
            }
            $creneaux = array_values(array_unique($creneaux));
            sort($creneaux);
            if (!empty($creneaux)) {
                $jours[] = [
                    'date'        => $date->toDateString(),
                    'date_label'  => $date->isoFormat('dddd D MMMM'),
                    'is_today'    => $date->isToday(),
                    'is_tomorrow' => $date->isTomorrow(),
                    'creneaux'    => $creneaux,
                ];
            }
        }

        return response()->json(['jours' => $jours, 'duree_totale' => $dureeTotale]);
    }

    protected function calculerCreneauxDisponiblesSplit(array $groupesData, Carbon $date): array
    {
        if (empty($groupesData)) return [];

        $firstGroup = $groupesData[0];
        $candidats  = $this->calculerCreneauxDisponibles($firstGroup['esthe'], $firstGroup['duree'], $date);
        $creneauxValides = [];

        foreach ($candidats as $creneau) {
            $heureEnCours = Carbon::parse($date->toDateString() . ' ' . $creneau);
            $tousDispos   = true;
            foreach ($groupesData as $groupe) {
                $debut = $heureEnCours->copy();
                $fin   = $debut->copy()->addMinutes($groupe['duree']);
                if (!$this->estheEstDisponible($groupe['esthe'], $debut, $fin)) {
                    $tousDispos = false;
                    break;
                }
                $heureEnCours->addMinutes($groupe['duree']);
            }
            if ($tousDispos) $creneauxValides[] = $creneau;
        }

        return $creneauxValides;
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'service_ids'      => ['required', 'array', 'min:1'],
            'service_ids.*'    => ['integer', 'exists:services,id'],
            'date'             => ['required', 'date', 'after_or_equal:today'],
            'heure'            => ['required', 'date_format:H:i'],
            'estheticienne_id' => ['nullable', 'integer', 'exists:users,id'],
            'note_client'      => ['nullable', 'string', 'max:500'],
            'code_promo'       => ['nullable', 'string', 'max:50'],
            'mode'             => ['nullable', 'in:simple,split'],
        ], [
            'service_ids.required' => 'Please select at least one service.',
            'date.required'        => 'Please choose a date.',
            'heure.required'       => 'Please choose a time slot.',
        ]);

        $serviceIds   = $request->service_ids;
        $services     = Service::whereIn('id', $serviceIds)->where('actif', true)->get();

        if ($services->count() !== count($serviceIds)) {
            return back()->withInput()->with('error', 'One or more services are invalid.');
        }

        $dateDebut    = Carbon::parse($request->date . ' ' . $request->heure);
        $prixOriginal = $services->sum('prix');
        $codePromoId  = null;
        $codePromoObj = null;
        $prixFinal    = $prixOriginal;

        if ($request->filled('code_promo')) {
            $code      = strtoupper(trim($request->code_promo));
            $codePromo = CodePromo::where('code', $code)->first();

            if (!$codePromo)
                return back()->withInput()->with('error', 'Invalid promo code.');

            $now = now();
            if (!$codePromo->actif || $codePromo->date_debut > $now || $codePromo->date_fin < $now)
                return back()->withInput()->with('error', 'This promo code is not currently valid.');

            if ($codePromo->limite_utilisation && $codePromo->nombre_utilisations >= $codePromo->limite_utilisation)
                return back()->withInput()->with('error', 'This promo code has reached its usage limit.');

            if (!in_array($codePromo->applicable_a, ['services', 'les_deux']))
                return back()->withInput()->with('error', 'This promo code is not applicable to services.');

            $reduction = $codePromo->type_reduction === 'pourcentage'
                ? (int) round($prixOriginal * $codePromo->valeur / 100)
                : $codePromo->valeur;

            $prixFinal    = max(0, $prixOriginal - $reduction);
            $codePromoId  = $codePromo->id;
            $codePromoObj = $codePromo;
        }

        $mode = $request->input('mode', 'simple');

        if ($mode === 'simple') {
            $dureeTotale = $services->sum('duree');
            $dateFin     = $dateDebut->copy()->addMinutes($dureeTotale);

            if ($request->filled('estheticienne_id')) {
                $estheticienne = User::find($request->estheticienne_id);

                if (!$estheticienne || !$estheticienne->isEstheticienne() || !$estheticienne->estActif())
                    return back()->withInput()->with('error', 'Invalid expert.');

                $servicesEsthe = $estheticienne->servicesProposes->pluck('id')->toArray();
                if (!empty(array_diff($serviceIds, $servicesEsthe)))
                    return back()->withInput()->with('error', 'This expert does not offer all the selected services.');

                if (!$this->estheEstDisponible($estheticienne, $dateDebut, $dateFin))
                    return back()->withInput()->with('error', 'This time slot is no longer available. Please choose another.');

                $modeAuto = false;
            } else {
                $estheticienne = $this->trouverEstheDisponible($serviceIds, $dateDebut, $dateFin);
                if (!$estheticienne)
                    return back()->withInput()->with('error', 'No expert available for this time slot.');
                $modeAuto = true;
            }

            $rdv = null;
            DB::transaction(function () use (
                $request, $estheticienne, $services, $dateDebut, $dateFin,
                $codePromoId, $codePromoObj, $prixOriginal, $prixFinal, $dureeTotale, &$rdv
            ) {
                if ($codePromoObj) $codePromoObj->increment('nombre_utilisations');

                $rdv = RendezVous::create([
                    'client_id'          => $request->user()->id,
                    'estheticienne_id'   => $estheticienne->id,
                    'date_debut'         => $dateDebut,
                    'date_fin'           => $dateFin,
                    'duree_totale'       => $dureeTotale,
                    'prix_original'      => $prixOriginal,
                    'prix_final'         => $prixFinal,
                    'code_promo_id'      => $codePromoId,
                    'statut'             => 'en_attente',
                    'notes'              => $request->note_client,
                    'groupe_reservation' => null,
                ]);

                foreach ($services as $service) {
                    $rdv->services()->attach($service->id, [
                        'prix_au_moment'  => $service->prix,
                        'duree_au_moment' => $service->duree,
                    ]);
                }
            });

            // ── Email + notifications ────────────────────────────────────
            if ($rdv) {
                $rdv->load(['client', 'estheticienne', 'services']);

                // ✅ Email esthéticienne
                try {
                    Mail::to($estheticienne->email)->send(new NouveauRdvEsthe(rdv: $rdv));
                } catch (\Exception $e) {
                    \Log::error('Email NouveauRdvEsthe: ' . $e->getMessage());
                }

                // ✅ Notification in-app esthéticienne
                try {
                    $estheticienne->notifications()->create([
                        'id'      => \Illuminate\Support\Str::uuid(),
                        'type'    => 'nouveau_rdv',
                        'data'    => json_encode([
                            'message' => '📅 New appointment request from ' . $rdv->client->fullName() . ' on ' . $rdv->date_debut->format('d/m/Y at H:i') . '.',
                        ]),
                        'read_at' => null,
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Notification esthe NouveauRdv: ' . $e->getMessage());
                }

                // ✅ Notification in-app client
                try {
                    $rdv->client->notifications()->create([
                        'id'      => \Illuminate\Support\Str::uuid(),
                        'type'    => 'rdv_en_attente',
                        'data'    => json_encode([
                            'message' => '📋 Your appointment on ' . $rdv->date_debut->format('d/m/Y at H:i') . ' is pending confirmation by ' . $rdv->estheticienne->fullName() . '.',
                        ]),
                        'read_at' => null,
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Notification client NouveauRdv: ' . $e->getMessage());
                }
            }

            $msg = $modeAuto
                ? 'Your appointment has been booked! An expert will be assigned and confirm shortly.'
                : 'Your appointment has been booked! Your expert will confirm it shortly.';

            return redirect()->route('client.rendez-vous.index')->with('success', $msg);
        }

        $request->validate([
            'groupes'                 => ['required', 'array', 'min:2'],
            'groupes.*.esthe_id'      => ['required', 'integer', 'exists:users,id'],
            'groupes.*.service_ids'   => ['required', 'array', 'min:1'],
            'groupes.*.service_ids.*' => ['integer', 'exists:services,id'],
        ]);

        $groupes      = $request->input('groupes');
        $groupeUUID   = Str::uuid()->toString();
        $heureEnCours = $dateDebut->copy();
        $nbRdvCreated = 0;
        $rdvsCreated  = [];

        try {
            DB::transaction(function () use (
                $request, $groupes, $groupeUUID, $heureEnCours,
                $codePromoId, $codePromoObj, $prixOriginal, $prixFinal,
                &$nbRdvCreated, &$rdvsCreated
            ) {
                if ($codePromoObj) $codePromoObj->increment('nombre_utilisations');

                $prixTotalGroupes = 0;
                $groupesData      = [];

                foreach ($groupes as $groupe) {
                    $esthe = User::findOrFail($groupe['esthe_id']);
                    $svcs  = Service::whereIn('id', $groupe['service_ids'])->where('actif', true)->get();
                    $duree = $svcs->sum('duree');
                    $prix  = $svcs->sum('prix');
                    $prixTotalGroupes += $prix;
                    $groupesData[]    = compact('esthe', 'svcs', 'duree', 'prix');
                }

                foreach ($groupesData as $gData) {
                    $debut = $heureEnCours->copy();
                    $fin   = $debut->copy()->addMinutes($gData['duree']);

                    if (!$this->estheEstDisponible($gData['esthe'], $debut, $fin)) {
                        throw new \Exception(
                            'The slot is no longer available for ' . $gData['esthe']->fullName() . '. Please choose another time.'
                        );
                    }

                    $prixGroupeFinal = $prixTotalGroupes > 0
                        ? (int) round($prixFinal * $gData['prix'] / $prixTotalGroupes)
                        : $gData['prix'];

                    $rdv = RendezVous::create([
                        'client_id'          => $request->user()->id,
                        'estheticienne_id'   => $gData['esthe']->id,
                        'date_debut'         => $debut,
                        'date_fin'           => $fin,
                        'duree_totale'       => $gData['duree'],
                        'prix_original'      => $gData['prix'],
                        'prix_final'         => $prixGroupeFinal,
                        'code_promo_id'      => $codePromoId,
                        'statut'             => 'en_attente',
                        'notes'              => $request->note_client,
                        'groupe_reservation' => $groupeUUID,
                    ]);

                    foreach ($gData['svcs'] as $service) {
                        $rdv->services()->attach($service->id, [
                            'prix_au_moment'  => $service->prix,
                            'duree_au_moment' => $service->duree,
                        ]);
                    }

                    $rdvsCreated[] = $rdv;
                    $heureEnCours->addMinutes($gData['duree']);
                    $nbRdvCreated++;
                }
            });
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        // ── Email + notifications à chaque esthéticienne ─────────────────
        foreach ($rdvsCreated as $rdv) {
            $rdv->load(['client', 'estheticienne', 'services']);

            // ✅ Email esthéticienne
            try {
                Mail::to($rdv->estheticienne->email)->send(new NouveauRdvEsthe(rdv: $rdv));
            } catch (\Exception $e) {
                \Log::error('Email NouveauRdvEsthe split: ' . $e->getMessage());
            }

            // ✅ Notification in-app esthéticienne
            try {
                $rdv->estheticienne->notifications()->create([
                    'id'      => \Illuminate\Support\Str::uuid(),
                    'type'    => 'nouveau_rdv',
                    'data'    => json_encode([
                        'message' => '📅 New appointment request from ' . $rdv->client->fullName() . ' on ' . $rdv->date_debut->format('d/m/Y at H:i') . '.',
                    ]),
                    'read_at' => null,
                ]);
            } catch (\Exception $e) {
                \Log::error('Notification esthe split: ' . $e->getMessage());
            }
        }

        // ✅ Notification in-app client (une seule notif pour tout le groupe)
        if (!empty($rdvsCreated)) {
            try {
                $premierRdv = $rdvsCreated[0];
                $premierRdv->client->notifications()->create([
                    'id'      => \Illuminate\Support\Str::uuid(),
                    'type'    => 'rdv_en_attente',
                    'data'    => json_encode([
                        'message' => '📋 Your booking of ' . $nbRdvCreated . ' appointment(s) on ' . $premierRdv->date_debut->format('d/m/Y at H:i') . ' is pending confirmation.',
                    ]),
                    'read_at' => null,
                ]);
            } catch (\Exception $e) {
                \Log::error('Notification client split: ' . $e->getMessage());
            }
        }

        return redirect()->route('client.rendez-vous.index')
            ->with('success', "Your booking is confirmed across $nbRdvCreated appointments. Each expert will confirm their slot shortly.");
    }

    protected function calculerCreneauxDisponibles(User $estheticienne, int $dureeMinutes, Carbon $date): array
    {
        $institut         = Institut::instance();
        $horairesInstitut = $institut->horaires_ouverture ?? [];
        $jourSemaine      = $date->dayOfWeekIso;
        $joursEn          = [1=>'lundi',2=>'mardi',3=>'mercredi',4=>'jeudi',5=>'vendredi',6=>'samedi',7=>'dimanche'];
        $jourKey          = $joursEn[$jourSemaine] ?? null;
        $horaireJour      = $horairesInstitut[$jourKey] ?? null;

        if (!$horaireJour || !($horaireJour['ouvert'] ?? false)) return [];

        $disponibilites = $estheticienne->disponibilites()
            ->where('jour_semaine', $jourSemaine)
            ->where('actif', true)
            ->orderBy('heure_debut')
            ->get();

        if ($disponibilites->isEmpty()) return [];

        $indisponibilites = $estheticienne->indisponibilites()
            ->where('date_debut', '<=', $date->copy()->endOfDay())
            ->where('date_fin', '>=', $date->copy()->startOfDay())
            ->get();

        $rdvExistants = $estheticienne->rendezVousAssignes()
            ->whereDate('date_debut', $date->toDateString())
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->get();

        $creneaux   = [];
        $intervalle = 30;

        foreach ($disponibilites as $dispo) {
            $debutDispo    = Carbon::parse($date->toDateString() . ' ' . $dispo->heure_debut);
            $finDispo      = Carbon::parse($date->toDateString() . ' ' . $dispo->heure_fin);
            $creneauActuel = $debutDispo->copy();

            while ($creneauActuel->copy()->addMinutes($dureeMinutes) <= $finDispo) {
                $finCreneau = $creneauActuel->copy()->addMinutes($dureeMinutes);

                if (
                    !$this->creneauDansHorairesInstitut($creneauActuel, $finCreneau, $horaireJour) ||
                    $this->creneauChevaucheIndispo($creneauActuel, $finCreneau, $indisponibilites) ||
                    $this->creneauChevaucheRdv($creneauActuel, $finCreneau, $rdvExistants) ||
                    ($date->isToday() && $creneauActuel->isPast())
                ) {
                    $creneauActuel->addMinutes($intervalle);
                    continue;
                }

                $creneaux[] = $creneauActuel->format('H:i');
                $creneauActuel->addMinutes($intervalle);
            }
        }

        return array_unique($creneaux);
    }

    protected function creneauDansHorairesInstitut(Carbon $debut, Carbon $fin, array $horaireJour): bool
    {
        $matinOk     = !empty($horaireJour['matin'])      && $this->creneauDansPlage($debut, $fin, $horaireJour['matin'],      $debut->toDateString());
        $apresMidiOk = !empty($horaireJour['apres_midi']) && $this->creneauDansPlage($debut, $fin, $horaireJour['apres_midi'], $debut->toDateString());
        return $matinOk || $apresMidiOk;
    }

    protected function creneauDansPlage(Carbon $debut, Carbon $fin, string $plage, string $date): bool
    {
        $parts = explode('-', $plage);
        if (count($parts) !== 2) return false;
        $plageDebut = Carbon::parse($date . ' ' . trim($parts[0]));
        $plageFin   = Carbon::parse($date . ' ' . trim($parts[1]));
        return $debut >= $plageDebut && $fin <= $plageFin;
    }

    protected function creneauChevaucheIndispo(Carbon $debut, Carbon $fin, $indisponibilites): bool
    {
        foreach ($indisponibilites as $indispo) {
            if ($debut < $indispo->date_fin && $fin > $indispo->date_debut) return true;
        }
        return false;
    }

    protected function creneauChevaucheRdv(Carbon $debut, Carbon $fin, $rdvExistants): bool
    {
        foreach ($rdvExistants as $rdv) {
            if ($debut < $rdv->date_fin && $fin > $rdv->date_debut) return true;
        }
        return false;
    }

    protected function estheEstDisponible(User $esthe, Carbon $dateDebut, Carbon $dateFin): bool
    {
        $institut         = Institut::instance();
        $horairesInstitut = $institut->horaires_ouverture ?? [];
        $jourSemaine      = $dateDebut->dayOfWeekIso;
        $joursEn          = [1=>'lundi',2=>'mardi',3=>'mercredi',4=>'jeudi',5=>'vendredi',6=>'samedi',7=>'dimanche'];
        $jourKey          = $joursEn[$jourSemaine] ?? null;
        $horaireJour      = $horairesInstitut[$jourKey] ?? null;

        if (!$horaireJour || !($horaireJour['ouvert'] ?? false)) return false;
        if (!$this->creneauDansHorairesInstitut($dateDebut, $dateFin, $horaireJour)) return false;

        $disposJour = $esthe->disponibilites()
            ->where('jour_semaine', $jourSemaine)
            ->where('actif', true)
            ->get();

        $aDispo = false;
        foreach ($disposJour as $dispo) {
            $debutDispo = Carbon::parse($dateDebut->toDateString() . ' ' . $dispo->heure_debut);
            $finDispo   = Carbon::parse($dateDebut->toDateString() . ' ' . $dispo->heure_fin);
            if ($dateDebut >= $debutDispo && $dateFin <= $finDispo) {
                $aDispo = true;
                break;
            }
        }
        if (!$aDispo) return false;

        if ($esthe->indisponibilites()
            ->where('date_debut', '<', $dateFin)
            ->where('date_fin', '>', $dateDebut)
            ->exists()) return false;

        if ($esthe->rendezVousAssignes()
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->where('date_debut', '<', $dateFin)
            ->where('date_fin', '>', $dateDebut)
            ->exists()) return false;

        if ($dateDebut->isPast()) return false;

        return true;
    }

    protected function trouverEstheDisponible(array $serviceIds, Carbon $dateDebut, Carbon $dateFin): ?User
    {
        $esthes = User::where('role', 'estheticienne')
            ->where('statut_compte', 'actif')
            ->whereHas('servicesProposes', fn($q) => $q->whereIn('services.id', $serviceIds), '=', count($serviceIds))
            ->get();

        foreach ($esthes as $esthe) {
            if ($this->estheEstDisponible($esthe, $dateDebut, $dateFin)) return $esthe;
        }
        return null;
    }
}
