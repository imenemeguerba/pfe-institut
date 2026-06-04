<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FactureController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->query('type', 'toutes');
        $user = $request->user();

        $query = $user->factures()
            ->with(['commande', 'rendezVous.services'])
            ->orderByDesc('date_emission');

        if ($type === 'rdv')       $query->where('type', 'rendez_vous');
        elseif ($type === 'commandes') $query->where('type', 'commande');

        $factures = $query->paginate(15)->withQueryString();

        return view('client.factures.index', compact('factures', 'type'));
    }

    public function show(Request $request, Facture $facture): View
    {
        if ($facture->client_id !== $request->user()->id) abort(403);
        $facture->load(['commande.produits', 'rendezVous.services', 'rendezVous.estheticienne']);
        return view('client.factures.show', compact('facture'));
    }

    public function telecharger(Request $request, Facture $facture)
    {
        if ($facture->client_id !== $request->user()->id) abort(403);

        if (!$facture->chemin_pdf || !Storage::disk('public')->exists($facture->chemin_pdf)) {
            return back()->with('error', 'PDF non disponible.');
        }

        return Storage::disk('public')->download(
            $facture->chemin_pdf,
            $facture->numero . '.pdf'
        );
    }
}
