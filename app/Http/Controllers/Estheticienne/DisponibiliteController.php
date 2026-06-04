<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisponibiliteRequest;
use App\Models\Disponibilite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DisponibiliteController extends Controller
{
    public function index(Request $request): View
    {
        $disponibilites = $request->user()
            ->disponibilites()
            ->orderBy('jour_semaine')
            ->orderBy('heure_debut')
            ->get();

        return view('estheticienne.disponibilites.index', compact('disponibilites'));
    }

    public function create(): View
    {
        return view('estheticienne.disponibilites.create');
    }

    public function store(DisponibiliteRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['estheticienne_id'] = $request->user()->id;

        // Vérifier qu'il n'y a pas de chevauchement avec une autre dispo le même jour
        $chevauche = Disponibilite::where('estheticienne_id', $request->user()->id)
            ->where('jour_semaine', $data['jour_semaine'])
            ->where(function($q) use ($data) {
                $q->whereBetween('heure_debut', [$data['heure_debut'], $data['heure_fin']])
                  ->orWhereBetween('heure_fin', [$data['heure_debut'], $data['heure_fin']])
                  ->orWhere(function($q2) use ($data) {
                      $q2->where('heure_debut', '<=', $data['heure_debut'])
                         ->where('heure_fin', '>=', $data['heure_fin']);
                  });
            })
            ->exists();

        if ($chevauche) {
            return back()->withInput()->with('error', 'Ce créneau chevauche une disponibilité existante.');
        }

        Disponibilite::create($data);

        return redirect()
            ->route('estheticienne.planning.index')
            ->with('success', 'Disponibilité ajoutée avec succès.');
    }

    public function edit(Disponibilite $disponibilite, Request $request): View
    {
        // Sécurité : vérifier que c'est sa dispo
        if ($disponibilite->estheticienne_id !== $request->user()->id) {
            abort(403);
        }

        return view('estheticienne.disponibilites.edit', compact('disponibilite'));
    }

    public function update(DisponibiliteRequest $request, Disponibilite $disponibilite): RedirectResponse
    {
        if ($disponibilite->estheticienne_id !== $request->user()->id) {
            abort(403);
        }

        $data = $request->validated();

        // Vérifier chevauchement (sauf avec elle-même)
        $chevauche = Disponibilite::where('estheticienne_id', $request->user()->id)
            ->where('id', '!=', $disponibilite->id)
            ->where('jour_semaine', $data['jour_semaine'])
            ->where(function($q) use ($data) {
                $q->whereBetween('heure_debut', [$data['heure_debut'], $data['heure_fin']])
                  ->orWhereBetween('heure_fin', [$data['heure_debut'], $data['heure_fin']])
                  ->orWhere(function($q2) use ($data) {
                      $q2->where('heure_debut', '<=', $data['heure_debut'])
                         ->where('heure_fin', '>=', $data['heure_fin']);
                  });
            })
            ->exists();

        if ($chevauche) {
            return back()->withInput()->with('error', 'Ce créneau chevauche une autre disponibilité.');
        }

        $disponibilite->update($data);

        return redirect()
            ->route('estheticienne.planning.index')
            ->with('success', 'Disponibilité modifiée avec succès.');
    }

    public function destroy(Disponibilite $disponibilite, Request $request): RedirectResponse
    {
        if ($disponibilite->estheticienne_id !== $request->user()->id) {
            abort(403);
        }

        $disponibilite->delete();

        return redirect()
            ->route('estheticienne.planning.index')
            ->with('success', 'Disponibilité supprimée.');
    }
}
