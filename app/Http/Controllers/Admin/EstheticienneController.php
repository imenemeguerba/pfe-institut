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
    public function index(Request $request): View
    {
        $filtre = $request->query('filtre', 'en_attente');

        // Exclure les comptes supprimés de la vue principale
        $query = User::estheticiennes()->nonSupprimes()->orderByDesc('created_at');

        if ($filtre === 'en_attente') {
            $query->enAttenteValidation();
        } elseif ($filtre === 'actives') {
            $query->actifs();
        } elseif ($filtre === 'desactives') {
            $query->where('statut_compte', 'desactive');
        }

        $estheticiennes = $query->paginate(15);

        $compteurs = [
            'en_attente' => User::estheticiennes()->enAttenteValidation()->count(),
            'actives' => User::estheticiennes()->actifs()->count(),
            'desactives' => User::estheticiennes()->where('statut_compte', 'desactive')->count(),
            'toutes' => User::estheticiennes()->nonSupprimes()->count(),
        ];

        return view('admin.estheticiennes.index', compact('estheticiennes', 'filtre', 'compteurs'));
    }

    public function show(User $estheticienne): View
    {
        if (!$estheticienne->isEstheticienne()) {
            abort(404);
        }

        $estheticienne->load('servicesProposes');
        $services = Service::actifs()->with('category')->get();

        return view('admin.estheticiennes.show', compact('estheticienne', 'services'));
    }

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
     * Refuse une demande d'inscription : bannit l'email à vie.
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

        // ⭐ Bannir l'email à vie (pas de date_libre_le → restera bloqué)
        $estheticienne->update([
            'statut_compte' => 'supprime',
            'motif_statut' => 'Demande d\'inscription refusée par l\'admin',
            'email_libre_le' => '9999-12-31 23:59:59', // Banni à vie
        ]);

        return redirect()
            ->route('admin.estheticiennes.index')
            ->with('success', 'La demande de ' . $nom . ' a été refusée. Cet email ne pourra plus être réutilisé.');
    }

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
     * Suppression définitive par l'admin : bannit l'email à vie.
     */
    public function destroy(User $estheticienne): RedirectResponse
    {
        if (!$estheticienne->isEstheticienne()) {
            abort(404);
        }

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

        // ⭐ Bannir l'email à vie (admin = pas de seconde chance)
        $estheticienne->update([
            'statut_compte' => 'supprime',
            'motif_statut' => 'Compte supprimé par l\'administrateur',
            'email_libre_le' => '9999-12-31 23:59:59', // Banni à vie
        ]);

        return redirect()
            ->route('admin.estheticiennes.index')
            ->with('success', 'Le compte de ' . $nom . ' a été supprimé. Cet email ne pourra plus être réutilisé.');
    }
}
