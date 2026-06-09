<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Institut;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AvisController extends Controller
{
    public function index(Request $request): View
    {
        $avis = Avis::where('client_id', $request->user()->id)
            ->with(['estheticienne'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('client.avis.index', compact('avis'));
    }

    /**
     * Formulaire pour laisser un avis sur une esthéticienne
     */
    public function createEsthe(Request $request, RendezVous $rendezVous): View
    {
        if ($rendezVous->client_id !== $request->user()->id) abort(403);
        if ($rendezVous->statut !== 'termine') abort(403, 'Le RDV doit être terminé pour laisser un avis.');

        // Vérifier si avis déjà soumis
        $avisExistant = Avis::where('client_id', $request->user()->id)
            ->where('rendez_vous_id', $rendezVous->id)
            ->where('type', 'estheticienne')
            ->first();

        return view('client.avis.create-esthe', compact('rendezVous', 'avisExistant'));
    }

    /**
     * Soumettre un avis sur une esthéticienne
     */
    public function storeEsthe(Request $request, RendezVous $rendezVous): RedirectResponse
    {
        if ($rendezVous->client_id !== $request->user()->id) abort(403);
        if ($rendezVous->statut !== 'termine') abort(403);

        $request->validate([
            'note'        => ['required', 'integer', 'min:1', 'max:5'],
            'commentaire' => ['nullable', 'string', 'max:1000'],
        ]);

        // Eviter les doublons
        $existant = Avis::where('client_id', $request->user()->id)
            ->where('rendez_vous_id', $rendezVous->id)
            ->where('type', 'estheticienne')
            ->first();

        if ($existant) {
            return back()->with('error', 'You have already submitted a review for this appointment.');
        }

        Avis::create([
            'client_id'        => $request->user()->id,
            'type'             => 'estheticienne',
            'estheticienne_id' => $rendezVous->estheticienne_id,
            'rendez_vous_id'   => $rendezVous->id,
            'note'             => $request->note,
            'commentaire'      => $request->commentaire ?? '',
            'statut'           => 'en_attente',
        ]);

        // Notifier l'admin
        try {
            User::where('role', 'admin')->first()
                ?->notifications()->create([
                    'id'      => \Illuminate\Support\Str::uuid(),
                    'type'    => 'nouvel_avis',
                    'data'    => json_encode(['message' => "⭐ New review pending moderation."]),
                    'read_at' => null,
                ]);
        } catch (\Exception $e) {}

        return redirect()->route('client.avis.index')
            ->with('success', 'Your review has been submitted and will be published after moderation.');
    }

    /**
     * Formulaire avis sur l'institut
     */
    public function createInstitut(): View
    {
        $avisExistant = Avis::where('client_id', auth()->id())
            ->where('type', 'institut')
            ->whereNotIn('statut', ['refuse'])
            ->first();

        return view('client.avis.create-institut', compact('avisExistant'));
    }

    /**
     * Soumettre avis sur l'institut
     */
    public function storeInstitut(Request $request): RedirectResponse
    {
        $request->validate([
            'note'        => ['required', 'integer', 'min:1', 'max:5'],
            'commentaire' => ['nullable', 'string', 'max:1000'],
        ]);

        $existant = Avis::where('client_id', $request->user()->id)
            ->where('type', 'institut')
            ->whereNotIn('statut', ['refuse'])
            ->first();

        if ($existant) {
            return back()->with('error', 'You already have a review for the institute.');
        }

        Avis::create([
            'client_id'   => $request->user()->id,
            'type'        => 'institut',
            'note'        => $request->note,
            'commentaire' => $request->commentaire ?? '',
            'statut'      => 'en_attente',
        ]);

        try {
            User::where('role', 'admin')->first()
                ?->notifications()->create([
                    'id'      => \Illuminate\Support\Str::uuid(),
                    'type'    => 'nouvel_avis',
                    'data'    => json_encode(['message' => "⭐ New institute review pending moderation."]),
                    'read_at' => null,
                ]);
        } catch (\Exception $e) {}

        return redirect()->route('client.avis.index')
            ->with('success', 'Your review has been submitted and will be published after moderation.');
    }

    public function modifier(Request $request, Avis $avi): RedirectResponse
    {
        if ($avi->client_id !== $request->user()->id) abort(403);

        $request->validate([
            'note'        => ['required', 'integer', 'min:1', 'max:5'],
            'commentaire' => ['nullable', 'string', 'max:1000'],
        ]);

        $avi->update([
            'note'        => $request->note,
            'commentaire' => $request->commentaire ?? '',
            'statut'      => 'en_attente', // Repart en modération
        ]);

        return back()->with('success', 'Review updated — sent back for moderation.');
    }

    public function supprimer(Request $request, Avis $avi): RedirectResponse
    {
        if ($avi->client_id !== $request->user()->id) abort(403);
        $avi->delete();
        return back()->with('success', 'Review deleted.');
    }
}
