<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CodePromoRequest;
use App\Models\CodePromo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CodePromoController extends Controller
{
    public function index(Request $request): View
    {
        $filtre = $request->query('filtre', 'tous');
        $search = $request->query('search', '');

        $query = CodePromo::orderByDesc('created_at');

        if ($filtre === 'actifs') {
            $query->where('actif', true)
                  ->where('date_debut', '<=', now())
                  ->where('date_fin', '>=', now());
        } elseif ($filtre === 'expires') {
            $query->where('date_fin', '<', now());
        } elseif ($filtre === 'inactifs') {
            $query->where('actif', false);
        }

        if ($search) {
            $query->where('code', 'like', '%' . strtoupper($search) . '%');
        }

        $codes = $query->paginate(15)->withQueryString();

        $compteurs = [
            'tous' => CodePromo::count(),
            'actifs' => CodePromo::where('actif', true)
                ->where('date_debut', '<=', now())
                ->where('date_fin', '>=', now())->count(),
            'expires' => CodePromo::where('date_fin', '<', now())->count(),
            'inactifs' => CodePromo::where('actif', false)->count(),
        ];

        return view('admin.codes-promo.index', compact('codes', 'filtre', 'search', 'compteurs'));
    }

    public function create(): View
    {
        return view('admin.codes-promo.create');
    }

    public function store(CodePromoRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['nombre_utilisations'] = 0;

        CodePromo::create($data);

        return redirect()
            ->route('admin.codes-promo.index')
            ->with('success', 'Promo code created successfully.');
    }

    public function show(CodePromo $codePromo): View
    {
        // Charger les bénéficiaires (RDV + commandes)
        $codePromo->load(['rendezVous.client', 'commandes.client']);

        return view('admin.codes-promo.show', compact('codePromo'));
    }

    public function edit(CodePromo $codePromo): View
    {
        return view('admin.codes-promo.edit', compact('codePromo'));
    }

    public function update(CodePromoRequest $request, CodePromo $codePromo): RedirectResponse
    {
        $codePromo->update($request->validated());

        return redirect()
            ->route('admin.codes-promo.index')
            ->with('success', 'Promo code updated successfully.');
    }

    public function destroy(CodePromo $codePromo): RedirectResponse
    {
        if ($codePromo->nombre_utilisations > 0) {
            return back()->with('error', 'This code has already been used. Deactivate it instead.');
        }

        $codePromo->delete();

        return redirect()
            ->route('admin.codes-promo.index')
            ->with('success', 'Promo code deleted successfully.');
    }

    public function toggleActif(CodePromo $codePromo): RedirectResponse
    {
        $codePromo->update(['actif' => !$codePromo->actif]);
        $status = $codePromo->actif ? 'activated' : 'deactivated';

        return redirect()
            ->route('admin.codes-promo.index')
            ->with('success', "Promo code {$status} successfully.");
    }
    public function toggle(\App\Models\CodePromo $codePromo): \Illuminate\Http\RedirectResponse
    {
        $codePromo->update(['actif' => !$codePromo->actif]);
        return back()->with('success', 'Promo code status updated.');
    }
}
