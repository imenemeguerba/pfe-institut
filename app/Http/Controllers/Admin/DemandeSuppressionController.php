<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandeSuppression;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DemandeSuppressionController extends Controller
{
    public function index(Request $request): View
    {
        $filtre = $request->query('filtre', 'en_attente');

        $query = DemandeSuppression::with('user')->orderByDesc('created_at');

        if ($filtre === 'en_attente') {
            $query->enAttente();
        } elseif ($filtre === 'acceptees') {
            $query->acceptees();
        } elseif ($filtre === 'refusees') {
            $query->refusees();
        }

        $demandes = $query->paginate(15);

        $compteurs = [
            'en_attente' => DemandeSuppression::enAttente()->count(),
            'acceptees' => DemandeSuppression::acceptees()->count(),
            'refusees' => DemandeSuppression::refusees()->count(),
            'toutes' => DemandeSuppression::count(),
        ];

        return view('admin.demandes-suppression.index', compact('demandes', 'filtre', 'compteurs'));
    }

    public function show(DemandeSuppression $demande): View
    {
        $demande->load('user');

        $rdvFuturs = collect();

        if ($demande->user->isClient()) {
            $rdvFuturs = $demande->user->rendezVous()
                ->where('date_debut', '>=', now())
                ->whereIn('statut', ['en_attente', 'confirme'])
                ->with('estheticienne')
                ->orderBy('date_debut')
                ->get();
        } elseif ($demande->user->isEstheticienne()) {
            $rdvFuturs = $demande->user->rendezVousAssignes()
                ->where('date_debut', '>=', now())
                ->whereIn('statut', ['en_attente', 'confirme'])
                ->with('client')
                ->orderBy('date_debut')
                ->get();
        }

        return view('admin.demandes-suppression.show', compact('demande', 'rdvFuturs'));
    }

    /**
     * Accepte la demande : soft delete + email réservé 1 mois.
     */
    public function accepter(DemandeSuppression $demande): RedirectResponse
    {
        if (!$demande->estEnAttente()) {
            return back()->with('error', 'This request has already been processed.');
        }

        $user = $demande->user;

        // Vérification automatique : pas de RDV futurs
        $rdvFuturs = 0;

        if ($user->isClient()) {
            $rdvFuturs = $user->rendezVous()
                ->where('date_debut', '>=', now())
                ->whereIn('statut', ['en_attente', 'confirme'])
                ->count();
        } elseif ($user->isEstheticienne()) {
            $rdvFuturs = $user->rendezVousAssignes()
                ->where('date_debut', '>=', now())
                ->whereIn('statut', ['en_attente', 'confirme'])
                ->count();
        }

        if ($rdvFuturs > 0) {
            return back()->with('error',
                'Cannot accept: this user has ' . $rdvFuturs . ' upcoming appointment(s). Please refuse this request.'
            );
        }

        // Marquer la demande comme acceptée
        $demande->update([
            'statut' => 'acceptee',
            'date_traitement' => now(),
        ]);

        $nom = $user->fullName();

        // ⭐ SOFT DELETE : on ne supprime pas vraiment, on marque "supprime"
        // L'email sera réutilisable dans 1 mois
        $user->update([
            'statut_compte' => 'supprime',
            'motif_statut' => 'Account deletion requested by user',
            'email_libre_le' => now()->addMonth(),
        ]);

        return redirect()
            ->route('admin.demandes-suppression.index')
            ->with('success', 'Request accepted. The account of ' . $nom . ' has been marked as deleted. The email will be available again in 1 month.');
    }

    public function refuser(Request $request, DemandeSuppression $demande): RedirectResponse
    {
        if (!$demande->estEnAttente()) {
            return back()->with('error', 'This request has already been processed.');
        }

        $request->validate([
            'motif_refus' => ['required', 'string', 'min:10', 'max:500'],
        ]);

        $demande->update([
            'statut' => 'refusee',
            'motif_refus' => $request->input('motif_refus'),
            'date_traitement' => now(),
        ]);

        return redirect()
            ->route('admin.demandes-suppression.index')
            ->with('success', 'Request refused. The user will be notified.');
    }
}
