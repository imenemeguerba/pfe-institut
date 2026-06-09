<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FactureController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search', '');
        $type   = $request->query('type', '');

        $query = Facture::with(['client', 'commande', 'rendezVous'])
            ->orderByDesc('date_emission');

        if ($type) $query->where('type', $type);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('numero', 'like', "%$search%")
                  ->orWhereHas('client', fn($q2) =>
                      $q2->where('prenom', 'like', "%$search%")
                         ->orWhere('nom', 'like', "%$search%")
                  );
            });
        }

        $factures = $query->paginate(20)->withQueryString();

        $counts = [
            'toutes'      => Facture::count(),
            'rdv'         => Facture::where('type', 'rendez_vous')->count(),
            'commandes'   => Facture::where('type', 'commande')->count(),
        ];

        return view('admin.factures.index', compact('factures', 'search', 'type', 'counts'));
    }

    public function show(Facture $facture): View
    {
        $facture->load(['client', 'commande.produits', 'rendezVous.services', 'rendezVous.estheticienne']);
        return view('admin.factures.show', compact('facture'));
    }

    public function telecharger(Facture $facture): StreamedResponse|\Illuminate\Http\Response
    {
        if (!$facture->chemin_pdf || !Storage::disk('public')->exists($facture->chemin_pdf)) {
            return back()->with('error', 'PDF not available for this invoice.');
        }

        return Storage::disk('public')->download(
            $facture->chemin_pdf,
            $facture->numero . '.pdf'
        );
    }
}
