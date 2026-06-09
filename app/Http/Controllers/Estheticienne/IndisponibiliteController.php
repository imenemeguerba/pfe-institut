<?php

namespace App\Http\Controllers\Estheticienne;

use App\Http\Controllers\Controller;
use App\Models\Indisponibilite;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class IndisponibiliteController extends Controller
{
    public function create(): View
    {
        return view('estheticienne.indisponibilites.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', Rule::in(['conge', 'maladie', 'formation', 'autre'])],
            'date_debut_jour' => ['required', 'date', 'after_or_equal:today'],
            'date_fin_jour' => ['required', 'date', 'after_or_equal:date_debut_jour'],
            'motif' => ['nullable', 'string', 'max:500'],
        ], [
            'date_debut_jour.required' => 'Start date is required.',
            'date_debut_jour.after_or_equal' => 'Start date must be today or later.',
            'date_fin_jour.required' => 'End date is required.',
            'date_fin_jour.after_or_equal' => 'End date must be after or equal to the start date.',
        ]);

        $dateDebut = Carbon::parse($validated['date_debut_jour'])->startOfDay();
        $dateFin = Carbon::parse($validated['date_fin_jour'])->endOfDay();

        // Vérifier qu'il n'y a pas de RDV planifiés pendant cette période
        $rdvConflits = $request->user()->rendezVousAssignes()
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->where('date_debut', '<', $dateFin)
            ->where('date_fin', '>', $dateDebut)
            ->count();

        if ($rdvConflits > 0) {
            return back()->withInput()->with('error', "You have {$rdvConflits} scheduled appointment(s) during this period. Please cancel them first or choose different dates.");
        }

        Indisponibilite::create([
            'estheticienne_id' => $request->user()->id,
            'type' => $validated['type'],
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'motif' => $validated['motif'] ?? null,
        ]);

        return redirect()->route('estheticienne.planning.index')->with('success', 'Absence recorded successfully.');
    }

    public function edit(Indisponibilite $indisponibilite): View
    {
        if ($indisponibilite->estheticienne_id !== auth()->id()) {
            abort(403);
        }
        return view('estheticienne.indisponibilites.edit', compact('indisponibilite'));
    }

    public function update(Request $request, Indisponibilite $indisponibilite): RedirectResponse
    {
        if ($indisponibilite->estheticienne_id !== $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'type' => ['required', Rule::in(['conge', 'maladie', 'formation', 'autre'])],
            'date_debut_jour' => ['required', 'date'],
            'date_fin_jour' => ['required', 'date', 'after_or_equal:date_debut_jour'],
            'motif' => ['nullable', 'string', 'max:500'],
        ]);

        $dateDebut = Carbon::parse($validated['date_debut_jour'])->startOfDay();
        $dateFin = Carbon::parse($validated['date_fin_jour'])->endOfDay();

        $indisponibilite->update([
            'type' => $validated['type'],
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'motif' => $validated['motif'] ?? null,
        ]);

        return redirect()->route('estheticienne.planning.index')->with('success', 'Absence updated.');
    }

    public function destroy(Indisponibilite $indisponibilite): RedirectResponse
    {
        if ($indisponibilite->estheticienne_id !== auth()->id()) {
            abort(403);
        }
        $indisponibilite->delete();
        return redirect()->route('estheticienne.planning.index')->with('success', 'Absence deleted.');
    }
}
