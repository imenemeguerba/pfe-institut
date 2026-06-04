<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EstheticienneController extends Controller
{
    public function show(Request $request, User $estheticienne, ?Service $service = null): View
    {
        if (!$estheticienne->isEstheticienne() || !$estheticienne->estActif()) {
            abort(404);
        }

        $estheticienne->load(['servicesProposes' => function($q) {
            $q->where('actif', true)->with('category');
        }]);

        $serviceSelectionne = null;
        if ($request->query('service')) {
            $serviceSelectionne = Service::find($request->query('service'));
            if ($serviceSelectionne && !$estheticienne->servicesProposes->contains($serviceSelectionne->id)) {
                $serviceSelectionne = null;
            }
        }

        $avis = Avis::with('client')
            ->where('type', 'estheticienne')
            ->where('estheticienne_id', $estheticienne->id)
            ->where('statut', 'publie')
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $noteMoyenne = $avis->avg('note') ?? 0;

        return view('client.estheticiennes.show', compact(
            'estheticienne', 'serviceSelectionne', 'avis', 'noteMoyenne'
        ));
    }
}