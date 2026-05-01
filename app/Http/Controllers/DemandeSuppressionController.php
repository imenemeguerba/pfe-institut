<?php

namespace App\Http\Controllers;

use App\Models\DemandeSuppression;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DemandeSuppressionController extends Controller
{
    /**
     * Crée une nouvelle demande de suppression de compte.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Vérifier qu'il n'a pas déjà une demande en cours
        $demandeExistante = DemandeSuppression::where('user_id', $user->id)
            ->where('statut', 'en_attente')
            ->first();

        if ($demandeExistante) {
            return back()->with('error', 'Vous avez déjà une demande de suppression en attente de traitement par l\'administrateur.');
        }

        // Validation du motif (optionnel)
        $request->validate([
            'motif_demande' => ['nullable', 'string', 'max:500'],
        ]);

        // Créer la demande
        DemandeSuppression::create([
            'user_id' => $user->id,
            'statut' => 'en_attente',
            'motif_demande' => $request->input('motif_demande'),
        ]);

        return back()->with('success', 'Votre demande de suppression a été envoyée à l\'administrateur. Vous serez notifié dès qu\'elle sera traitée.');
    }

    /**
     * Annule une demande de suppression en attente.
     */
    public function annuler(Request $request, DemandeSuppression $demande): RedirectResponse
    {
        // Sécurité : vérifier que c'est bien sa propre demande
        if ($demande->user_id !== $request->user()->id) {
            abort(403);
        }

        // Vérifier que la demande est encore en attente
        if (!$demande->estEnAttente()) {
            return back()->with('error', 'Cette demande a déjà été traitée et ne peut plus être annulée.');
        }

        $demande->delete();

        return back()->with('success', 'Votre demande de suppression a été annulée.');
    }
}
