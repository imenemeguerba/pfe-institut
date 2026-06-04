<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(\Illuminate\Http\Request $request): View
{
    $search = $request->query('search', '');
    $filtre = $request->query('filtre', 'tous');

    $query = Service::with(['category', 'estheticiennes'])->orderBy('nom');

    if ($filtre === 'actifs')      $query->where('actif', true);
    elseif ($filtre === 'inactifs') $query->where('actif', false);

    if ($search) {
        $query->where('nom', 'like', '%' . $search . '%');
    }

    $services = $query->paginate(15)->withQueryString();

    $compteurs = [
        'tous'    => Service::count(),
        'actifs'  => Service::where('actif', true)->count(),
        'inactifs'=> Service::where('actif', false)->count(),
    ];

    return view('admin.services.index', compact('services', 'search', 'filtre', 'compteurs'));
}

    public function create(): View
    {
        $categories     = Category::actives()->orderBy('nom')->get();
        $estheticiennes = User::estheticiennes()
            ->where('statut_compte', 'actif')
            ->orderBy('nom')
            ->get();

        return view('admin.services.create', compact('categories', 'estheticiennes'));
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $estheticiennesIds = $data['estheticiennes'] ?? [];
        unset($data['estheticiennes']);
        unset($data['variantes']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // Sauvegarder types_peau comme array (cast 'array' dans le model)
        $data['types_peau'] = $request->input('types_peau', []);

        $service = Service::create($data);

        if (!empty($estheticiennesIds)) {
            $service->estheticiennes()->sync($estheticiennesIds);
        }

        // Sauvegarder les variantes
        if ($request->has('variantes')) {
            VarianteController::syncService($service, $request->variantes);
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service): View
    {
        $categories     = Category::actives()->orderBy('nom')->get();
        $estheticiennes = User::estheticiennes()
            ->where('statut_compte', 'actif')
            ->orderBy('nom')
            ->get();

        $estheticiennesIds = $service->estheticiennes->pluck('id')->toArray();

        return view('admin.services.edit', compact('service', 'categories', 'estheticiennes', 'estheticiennesIds'));
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();

        $estheticiennesIds = $data['estheticiennes'] ?? [];
        unset($data['estheticiennes']);
        unset($data['variantes']);

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // Sauvegarder types_peau comme array (cast 'array' dans le model)
        $data['types_peau'] = $request->input('types_peau', []);

        $service->update($data);

        $service->estheticiennes()->sync($estheticiennesIds);

        // Sauvegarder les variantes
        if ($request->has('variantes')) {
            VarianteController::syncService($service, $request->variantes);
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service modifié avec succès.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $rdvCount = $service->rendezVous()->count();
        if ($rdvCount > 0) {
            return redirect()
                ->route('admin.services.index')
                ->with('error', 'Impossible : ce service a été utilisé dans ' . $rdvCount . ' rendez-vous. Désactivez-le plutôt.');
        }

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->estheticiennes()->detach();
        $service->variantes()->delete();
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service supprimé avec succès.');
    }

    public function toggle(Service $service): RedirectResponse
    {
        $service->update(['actif' => !$service->actif]);
        return back()->with('success', 'Statut du service mis à jour.');
    }
    

}