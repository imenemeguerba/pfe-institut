<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutRequest;
use App\Models\Institut;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InstitutController extends Controller
{
    /**
     * Affiche le formulaire d'édition des infos de l'institut.
     */
    public function edit(): View
    {
        $institut = Institut::instance();

        return view('admin.institut.edit', compact('institut'));
    }

    /**
     * Met à jour les infos de l'institut.
     */
    public function update(InstitutRequest $request): RedirectResponse
    {
        $institut = Institut::instance();
        $data = $request->validated();

        // ── Suppression logo ──────────────────────────────────────────────
        if ($request->input('supprimer_logo') === '1' && $institut->logo) {
            Storage::disk('public')->delete($institut->logo);
            $data['logo'] = null;
        }

        // ── Nouveau logo uploadé ──────────────────────────────────────────
        if ($request->hasFile('logo')) {
            if ($institut->logo) {
                Storage::disk('public')->delete($institut->logo);
            }
            $data['logo'] = $request->file('logo')->store('institut', 'public');
        }

        // ── Horaires ──────────────────────────────────────────────────────
        $horaires = [];
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

        foreach ($jours as $jour) {
            $ouvert    = $request->boolean('horaires_' . $jour . '_ouvert');
            $matin     = $request->input('horaires_' . $jour . '_matin');
            $apresMidi = $request->input('horaires_' . $jour . '_apres_midi');

            $horaires[$jour] = [
                'ouvert'    => $ouvert,
                'matin'     => $ouvert ? $matin     : null,
                'apres_midi'=> $ouvert ? $apresMidi : null,
            ];
        }

        $data['horaires_ouverture'] = $horaires;

        $institut->update($data);

        return redirect()
            ->route('admin.institut.edit')
            ->with('success', 'Institute information updated successfully.');
    }
}
