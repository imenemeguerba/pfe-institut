<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\AvantApres;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        $search     = $request->query('search', '');
        $categoryId = $request->query('categorie');
        $prixMax    = $request->query('prix_max');
        $dureeMax   = $request->query('duree_max');

        $query = Service::with(['category', 'estheticiennes'])
            ->where('actif', true)
            ->orderBy('nom');

        if ($search)     $query->where('nom', 'like', '%' . $search . '%');
        if ($categoryId) $query->where('category_id', $categoryId);
        if ($prixMax)    $query->where('prix', '<=', (int) $prixMax);
        if ($dureeMax)   $query->where('duree', '<=', (int) $dureeMax);

        $services   = $query->paginate(12)->withQueryString();
        $categories = Category::where('actif', true)->orderBy('nom')->get();

        if ($request->ajax() || $request->has('ajax')) {
            $html = view('client.services.partials.grid', compact('services'))->render();

            return response()->json([
                'html'         => $html,
                'total'        => $services->total(),
                'current_page' => $services->currentPage(),
                'last_page'    => $services->lastPage(),
            ]);
        }

        return view('client.services.index', compact(
            'services', 'categories', 'search', 'categoryId', 'prixMax', 'dureeMax'
        ));
    }

    public function show(Service $service): View
    {
        if (!$service->actif) abort(404);

        $service->load(['category', 'estheticiennes' => function($q) {
            $q->where('statut_compte', 'actif');
        }]);

        $avis = Avis::with('client')
            ->where('type', 'estheticienne')
            ->where('statut', 'publie')
            ->whereIn('estheticienne_id', $service->estheticiennes->pluck('id'))
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        $noteMoyenne = $avis->avg('note') ?? 0;

        $photosAvantApres = AvantApres::with('estheticienne')
            ->where('public', true)
            ->where('service', $service->nom)
            ->orderByDesc('created_at')
            ->get();

        return view('client.services.show', compact(
            'service', 'avis', 'noteMoyenne', 'photosAvantApres'
        ));
    }
}