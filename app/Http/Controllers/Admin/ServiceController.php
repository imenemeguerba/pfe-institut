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
    /**
     * Affiche la liste de tous les services.
     */
    public function index(): View
    {
        $services = Service::with(['category', 'estheticiennes'])
            ->orderBy('nom')
            ->paginate(15);
        
        return view('admin.services.index', compact('services'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create(): View
    {
        $categories = Category::actives()->orderBy('nom')->get();
        $estheticiennes = User::estheticiennes()
            ->where('statut_compte', 'actif')
            ->orderBy('nom')
            ->get();
        
        return view('admin.services.create', compact('categories', 'estheticiennes'));
    }

    /**
     * Enregistre un nouveau service.
     */
    public function store(ServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        // Récupérer les esthéticiennes avant de les retirer du tableau
        $estheticiennesIds = $data['estheticiennes'] ?? [];
        unset($data['estheticiennes']);
        
        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        
        // Créer le service
        $service = Service::create($data);
        
        // Associer les esthéticiennes (table pivot)
        if (!empty($estheticiennesIds)) {
            $service->estheticiennes()->sync($estheticiennesIds);
        }
        
        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service créé avec succès.');
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit(Service $service): View
    {
        $categories = Category::actives()->orderBy('nom')->get();
        $estheticiennes = User::estheticiennes()
            ->where('statut_compte', 'actif')
            ->orderBy('nom')
            ->get();
        
        // IDs des esthéticiennes déjà associées
        $estheticiennesIds = $service->estheticiennes->pluck('id')->toArray();
        
        return view('admin.services.edit', compact('service', 'categories', 'estheticiennes', 'estheticiennesIds'));
    }

    /**
     * Met à jour un service.
     */
    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();
        
        // Récupérer les esthéticiennes avant de les retirer du tableau
        $estheticiennesIds = $data['estheticiennes'] ?? [];
        unset($data['estheticiennes']);
        
        // Gestion de l'image (remplacement)
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        
        // Mettre à jour le service
        $service->update($data);
        
        // Mettre à jour les esthéticiennes associées
        $service->estheticiennes()->sync($estheticiennesIds);
        
        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service modifié avec succès.');
    }

    /**
     * Supprime un service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        // Vérifier s'il y a des RDV qui utilisent ce service
        $rdvCount = $service->rendezVous()->count();
        if ($rdvCount > 0) {
            return redirect()
                ->route('admin.services.index')
                ->with('error', 'Impossible de supprimer ce service : il a été utilisé dans ' . $rdvCount . ' rendez-vous. Désactivez-le plutôt.');
        }
        
        // Supprimer l'image associée
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        
        // Détacher les esthéticiennes (la table pivot)
        $service->estheticiennes()->detach();
        
        $service->delete();
        
        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service supprimé avec succès.');
    }

    /**
     * Active ou désactive rapidement un service (toggle).
     */
    public function toggleActif(Service $service): RedirectResponse
    {
        $service->update(['actif' => !$service->actif]);
        
        $status = $service->actif ? 'activé' : 'désactivé';
        
        return redirect()
            ->route('admin.services.index')
            ->with('success', "Service {$status} avec succès.");
    }

    // Note: les méthodes show() et destroy() (déjà incluse au-dessus) sont volontairement
    // omises car non utilisées dans ce CRUD admin.
}