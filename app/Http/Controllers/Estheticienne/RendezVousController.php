<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use App\Mail\RdvAnnuleClient;
use App\Mail\RdvConfirmeClient;
use App\Models\RendezVous;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use App\Services\FideliteService;

class RendezVousController extends Controller
{
    public function index(Request $request): View
    {
        $esthe        = $request->user();
        $filtreActuel = $request->query('filtre', 'en_attente');

        $query = $esthe->rendezVousAssignes()
            ->with(['client', 'services'])
            ->orderBy('date_debut', 'desc');

        if ($filtreActuel !== 'tous') {
            $query->where('statut', $filtreActuel);
        }

        $rendezVous = $query->paginate(15)->appends($request->query());

        $compteurs = [
            'en_attente' => $esthe->rendezVousAssignes()->where('statut', 'en_attente')->count(),
            'confirme'   => $esthe->rendezVousAssignes()->where('statut', 'confirme')->count(),
            'termine'    => $esthe->rendezVousAssignes()->where('statut', 'termine')->count(),
            'total'      => $esthe->rendezVousAssignes()->count(),
        ];

        return view('estheticienne.rendez-vous.index', compact('rendezVous', 'compteurs', 'filtreActuel'));
    }

    public function show(RendezVous $rendezVous): View
    {
        if ($rendezVous->estheticienne_id !== auth()->id()) abort(403);
        $rendezVous->load(['client', 'services.category']);
        return view('estheticienne.rendez-vous.show', compact('rendezVous'));
    }

    public function accepter(Request $request, RendezVous $rendezVous): RedirectResponse
    {
        if ($rendezVous->estheticienne_id !== $request->user()->id) abort(403);

        if ($rendezVous->statut !== 'en_attente') {
            return back()->with('error', 'This appointment can no longer be confirmed.');
        }

        $rendezVous->update(['statut' => 'confirme']);

        // ── Générer la facture ─────────────────────────────────────────
        try {
            \App\Services\FactureService::genererPourRdv($rendezVous);
        } catch (\Exception $e) {
            \Log::error('Facture confirmation RDV: ' . $e->getMessage());
        }

        $rendezVous->load(['client', 'estheticienne', 'services', 'facture']);

        // ✅ Email au client : confirmation + facture
        try {
            Mail::to($rendezVous->client->email)->send(new RdvConfirmeClient(
                rdv:           $rendezVous,
                facturePath:   $rendezVous->facture?->chemin_pdf,
                factureNumero: $rendezVous->facture?->numero,
            ));
        } catch (\Exception $e) {
            \Log::error('Email accepter RDV: ' . $e->getMessage());
        }

        // ✅ Notification in-app au client
        try {
            $rendezVous->client->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'rdv_confirme',
                'data'    => json_encode([
                    'message' => "✅ Your appointment on {$rendezVous->date_debut->format('d/m/Y at H:i')} has been confirmed by {$rendezVous->estheticienne->fullName()}.",
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Notification confirmation RDV client: ' . $e->getMessage());
        }

        return redirect()->route('estheticienne.rendez-vous.index')
            ->with('success', 'Appointment confirmed ✅ — Invoice generated.');
    }

    public function refuser(Request $request, RendezVous $rendezVous): RedirectResponse
    {
        if ($rendezVous->estheticienne_id !== $request->user()->id) abort(403);

        if ($rendezVous->statut !== 'en_attente') {
            return back()->with('error', 'This appointment can no longer be declined.');
        }

        $request->validate([
            'motif_refus' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $rendezVous->update([
            'statut'      => 'refuse',
            'motif_refus' => $request->motif_refus,
        ]);

        $rendezVous->load(['client', 'estheticienne', 'services']);

        // ✅ Email au client : refus
        try {
            Mail::to($rendezVous->client->email)->send(new RdvAnnuleClient(
                rdv:       $rendezVous,
                annulePar: 'estheticienne',
            ));
        } catch (\Exception $e) {
            \Log::error('Email refus RDV: ' . $e->getMessage());
        }

        // ✅ Notification in-app au client
        try {
            $rendezVous->client->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'rdv_refuse',
                'data'    => json_encode([
                    'message' => "❌ Your appointment on {$rendezVous->date_debut->format('d/m/Y at H:i')} has been declined by {$rendezVous->estheticienne->fullName()}. Reason: {$rendezVous->motif_refus}",
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Notification refus RDV client: ' . $e->getMessage());
        }

        return redirect()->route('estheticienne.rendez-vous.index')
            ->with('success', 'Appointment declined.');
    }

    public function terminer(Request $request, RendezVous $rendezVous): RedirectResponse
    {
        // ── Vérifier que le RDV est bien passé ────────────────────────
        if ($rendezVous->date_debut->isFuture()) {
            return back()->with('error', 'You cannot mark this appointment as completed before the scheduled time.');
        }

        if ($rendezVous->estheticienne_id !== $request->user()->id) abort(403);

        if ($rendezVous->statut !== 'confirme') {
            return back()->with('error', 'Only confirmed appointments can be marked as completed.');
        }

        $rendezVous->update(['statut' => 'termine']);

        // ✅ Points fidélité
        try {
            FideliteService::ajouterPourRdv($rendezVous->client, $rendezVous);
        } catch (\Exception $e) {
            \Log::error('Fidélité RDV: ' . $e->getMessage());
        }

        // ✅ Notification in-app au client
        try {
            $rendezVous->client->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'rdv_termine',
                'data'    => json_encode([
                    'message' => "✅ Your appointment on {$rendezVous->date_debut->format('d/m/Y at H:i')} is now complete. Your invoice is available.",
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {
            \Log::error('Notification RDV terminé: ' . $e->getMessage());
        }

        return redirect()->route('estheticienne.rendez-vous.index')
            ->with('success', 'Appointment marked as completed 🏁');
    }
}
