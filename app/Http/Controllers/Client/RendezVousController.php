<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\RdvAnnuleClient;
use App\Models\RendezVous;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RendezVousController extends Controller
{
    public function index(Request $request): View
    {
        $filtre = $request->query('filtre', 'a_venir');
        $user   = $request->user();

        $query = $user->rendezVous()->with(['estheticienne', 'services']);

        if ($filtre === 'a_venir') {
            $query->where('date_debut', '>=', now())
                  ->whereIn('statut', ['en_attente', 'confirme'])
                  ->orderBy('date_debut');
        } elseif ($filtre === 'passes') {
            $query->where('date_debut', '<', now())
                  ->orderByDesc('date_debut');
        } elseif ($filtre === 'annules') {
            $query->whereIn('statut', ['annule', 'refuse'])
                  ->orderByDesc('date_debut');
        } else {
            $query->orderByDesc('date_debut');
        }

        $tousRdvs = $query->get();

        $reservations   = collect();
        $groupesTraites = [];

        foreach ($tousRdvs as $rdv) {
            if ($rdv->groupe_reservation && !in_array($rdv->groupe_reservation, $groupesTraites)) {
                $rdvsGroupe = $tousRdvs->where('groupe_reservation', $rdv->groupe_reservation)->values();
                $reservations->push([
                    'type'   => 'groupe',
                    'groupe' => $rdv->groupe_reservation,
                    'rdvs'   => $rdvsGroupe,
                ]);
                $groupesTraites[] = $rdv->groupe_reservation;
            } elseif (!$rdv->groupe_reservation) {
                $reservations->push([
                    'type' => 'simple',
                    'rdv'  => $rdv,
                ]);
            }
        }

        $page      = $request->query('page', 1);
        $perPage   = 10;
        $total     = $reservations->count();
        $items     = $reservations->slice(($page - 1) * $perPage, $perPage)->values();
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $items, $total, $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('client.rendez-vous.index', compact('paginator', 'filtre'));
    }

    public function show(Request $request, RendezVous $rendezVous): View
    {
        if ($rendezVous->client_id !== $request->user()->id) abort(403);

        $rendezVous->load(['estheticienne', 'services', 'codePromo']);

        $rdvsGroupe = null;
        if ($rendezVous->groupe_reservation) {
            $rdvsGroupe = RendezVous::where('groupe_reservation', $rendezVous->groupe_reservation)
                ->where('id', '!=', $rendezVous->id)
                ->with(['estheticienne', 'services'])
                ->get();
        }

        return view('client.rendez-vous.show', compact('rendezVous', 'rdvsGroupe'));
    }

    public function annuler(Request $request, RendezVous $rendezVous): RedirectResponse
    {
        if ($rendezVous->client_id !== $request->user()->id) abort(403);

        if (!in_array($rendezVous->statut, ['en_attente', 'confirme']))
            return back()->with('error', 'This appointment can no longer be cancelled.');

        if ($rendezVous->date_debut->isPast())
            return back()->with('error', 'Cannot cancel a past appointment.');

        // ── RDV groupé → annuler tout le groupe ───────────────────────
        if ($rendezVous->groupe_reservation) {
            $rdvsGroupe = RendezVous::where('groupe_reservation', $rendezVous->groupe_reservation)
                ->whereIn('statut', ['en_attente', 'confirme'])
                ->with(['client', 'estheticienne', 'services'])
                ->get();

            $rdvsGroupe->each(function ($rdv) {
                $rdv->update([
                    'statut'      => 'annule',
                    'motif_refus' => 'Cancelled by client on ' . now()->format('d/m/Y H:i'),
                ]);

                // ✅ Email au client
                try {
                    Mail::to($rdv->client->email)->send(new RdvAnnuleClient(
                        rdv:       $rdv,
                        annulePar: 'client',
                    ));
                } catch (\Exception $e) {
                    \Log::error('Email annulation RDV groupe client: ' . $e->getMessage());
                }

                // ✅ Email à l'esthéticienne
                try {
                    Mail::to($rdv->estheticienne->email)->send(new RdvAnnuleClient(
                        rdv:       $rdv,
                        annulePar: 'client',
                    ));
                } catch (\Exception $e) {
                    \Log::error('Email annulation RDV groupe esthe: ' . $e->getMessage());
                }

                // ✅ Notification in-app à l'esthéticienne
                try {
                    $rdv->estheticienne->notifications()->create([
                        'id'      => \Illuminate\Support\Str::uuid(),
                        'type'    => 'rdv_annule',
                        'data'    => json_encode([
                            'message' => "❌ {$rdv->client->fullName()} cancelled the appointment on {$rdv->date_debut->format('d/m/Y at H:i')}.",
                        ]),
                        'read_at' => null,
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Notification annulation RDV groupe esthe: ' . $e->getMessage());
                }
            });

            return redirect()->route('client.rendez-vous.index')
                ->with('success', 'Your entire booking has been cancelled.');
        }

        // ── RDV simple ─────────────────────────────────────────────────
        $rendezVous->load(['client', 'estheticienne', 'services']);
        $rendezVous->update([
            'statut'      => 'annule',
            'motif_refus' => 'Cancelled by client on ' . now()->format('d/m/Y H:i'),
        ]);

        // ✅ Email au client
        try {
            Mail::to($rendezVous->client->email)->send(new RdvAnnuleClient(
                rdv:       $rendezVous,
                annulePar: 'client',
            ));
        } catch (\Exception $e) {
            \Log::error('Email annulation RDV client: ' . $e->getMessage());
        }

        // ✅ Email à l'esthéticienne
        try {
            Mail::to($rendezVous->estheticienne->email)->send(new RdvAnnuleClient(
                rdv:       $rendezVous,
                annulePar: 'client',
            ));
        } catch (\Exception $e) {
            \Log::error('Email annulation RDV esthe: ' . $e->getMessage());
        }

        // ✅ Notification in-app à l'esthéticienne
        try {
            $rendezVous->estheticienne->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'rdv_annule',
                'data'    => json_encode([
                    'message' => "❌ {$rendezVous->client->fullName()} cancelled the appointment on {$rendezVous->date_debut->format('d/m/Y at H:i')}.",
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Notification annulation RDV esthe: ' . $e->getMessage());
        }

        return redirect()->route('client.rendez-vous.index')
            ->with('success', 'Your appointment has been cancelled.');
    }
}
