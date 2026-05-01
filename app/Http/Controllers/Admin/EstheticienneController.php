<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EstheticienneController extends Controller
{
    /**
     * Affiche la liste des esthéticiennes avec filtres par statut.
     */
    public function index(Request $request): View
    {
        // Récupérer le filtre actuel (par défaut : en attente)
        $filtre = $request->query('filtre', 'en_attente');

        // Construire la requête de base
        $query = User::estheticiennes()->orderByDesc('created_at');

        // Appliquer le filtre
        if ($filtre === 'en_attente') {
            $query->enAttenteValidation();
        } elseif ($filtre === 'actives') {
            $query->actifs();
        } elseif ($filtre === 'desactives') {
            $query->where('statut_compte', 'desactive');
        }
        // Si 'toutes', pas de filtre

        $estheticiennes = $query->paginate(15);

        // Compteurs pour les onglets
        $compteurs = [
            'en_attente' => User::estheticiennes()->enAttenteValidation()->count(),
            'actives' => User::estheticiennes()->actifs()->count(),
            'desactives' => User::estheticiennes()->where('statut_compte', 'desactive')->count(),
            'toutes' => User::estheticiennes()->count(),
        ];

        return view('admin.estheticiennes.index', compact('estheticiennes', 'filtre', 'compteurs'));
    }

    /**
     * Affiche les détails d'une esthéticienne.
     */
    public function show(User $estheticienne): View
    {
        // Sécurité : vérifier que c'est bien une esthéticienne
        if (!$estheticienne->isEstheticienne()) {
            abort(404);
        }

        // Charger les services associés (s'il y en a)
        $estheticienne->load('servicesProposes');

        // Tous les services disponibles pour l'association
        $services = Service::actifs()->with('category')->get();

        return view('admin.estheticiennes.show', compact('estheticienne', 'services'));
    }

    /**
     * Accepte une demande d'inscription esthéticienne.
     */
    public function accepter(User $estheticienne): RedirectResponse
    {
        if (!$estheticienne->isEstheticienne() || !$estheticienne->estEnAttenteValidation()) {
            return back()->with('error', 'Cette demande a déjà été traitée.');
        }

        $estheticienne->update([
            'statut_compte' => 'actif',
            'motif_statut' => null,
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('admin.estheticiennes.show', $estheticienne)
            ->with('success', 'Demande acceptée avec succès. ' . $estheticienne->fullName() . ' peut maintenant se connecter.');
    }

    /**
     * Refuse une demande d'inscription esthéticienne (suppression du compte).
     */
    public function refuser(Request $request, User $estheticienne): RedirectResponse
    {
        if (!$estheticienne->isEstheticienne() || !$estheticienne->estEnAttenteValidation()) {
            return back()->with('error', 'Cette demande a déjà été traitée.');
        }

        $request->validate([
            'motif_refus' => ['nullable', 'string', 'max:500'],
        ]);

        $nom = $estheticienne->fullName();
        $estheticienne->delete();

        return redirect()
            ->route('admin.estheticiennes.index')
            ->with('success', 'La demande de ' . $nom . ' a été refusée et le compte supprimé.');
    }

    /**
     * Désactive une esthéticienne active.
     */
    public function desactiver(Request $request, User $estheticienne): RedirectResponse
    {
        if (!$estheticienne->isEstheticienne() || !$estheticienne->estActif()) {
            return back()->with('error', 'Cette esthéticienne n\'est pas active.');
        }

        $request->validate([
            'motif' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $estheticienne->update([
            'statut_compte' => 'desactive',
            'motif_statut' => $request->input('motif'),
        ]);

        return redirect()
            ->route('admin.estheticiennes.show', $estheticienne)
            ->with('success', 'Esthéticienne désactivée avec succès.');
    }

    /**
     * Réactive une esthéticienne désactivée.
     */
    public function reactiver(User $estheticienne): RedirectResponse
    {
        if (!$estheticienne->isEstheticienne() || $estheticienne->statut_compte !== 'desactive') {
            return back()->with('error', 'Cette esthéticienne n\'est pas désactivée.');
        }

        $estheticienne->update([
            'statut_compte' => 'actif',
            'motif_statut' => null,
        ]);

        return redirect()
            ->route('admin.estheticiennes.show', $estheticienne)
            ->with('success', 'Esthéticienne réactivée avec succès.');
    }

    /**
     * Met à jour les services associés à une esthéticienne.
     */
    public function updateServices(Request $request, User $estheticienne): RedirectResponse
    {
        if (!$estheticienne->isEstheticienne()) {
            abort(404);
        }

        $request->validate([
            'services' => ['nullable', 'array'],
            'services.*' => ['exists:services,id'],
        ]);

        $estheticienne->servicesProposes()->sync($request->input('services', []));

        return redirect()
            ->route('admin.estheticiennes.show', $estheticienne)
            ->with('success', 'Services associés mis à jour avec succès.');
    }

    /**
     * Supprime définitivement un compte esthéticienne.
     * Refuse si elle a des RDV futurs.
     */
    public function destroy(User $estheticienne): RedirectResponse
    {
        if (!$estheticienne->isEstheticienne()) {
            abort(404);
        }

        // Ne pas supprimer si elle a des RDV futurs
        $rdvFuturs = $estheticienne->rendezVousAssignes()
            ->where('date_debut', '>=', now())
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->count();

        if ($rdvFuturs > 0) {
            return back()->with('error',
                'Impossible de supprimer ce compte : ' . $estheticienne->fullName() .
                ' a ' . $rdvFuturs . ' rendez-vous à venir. Désactivez le compte ou attendez la fin des rendez-vous.'
            );
        }

        $nom = $estheticienne->fullName();
        $estheticienne->delete();

        return redirect()
            ->route('admin.estheticiennes.index')
            ->with('success', 'Le compte de ' . $nom . ' a été supprimé définitivement.');
    }
}
