<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AvisController extends Controller
{
    public function index(Request $request): View
    {
        $filtre = $request->query('filtre', 'en_attente');
        $type   = $request->query('type', '');

        $query = Avis::with(['client', 'estheticienne', 'rendezVous'])
            ->orderByDesc('created_at');

        if ($filtre === 'en_attente') $query->where('statut', 'en_attente');
        elseif ($filtre === 'publies')  $query->where('statut', 'publie');
        elseif ($filtre === 'refuses')  $query->where('statut', 'refuse');

        if ($type === 'estheticienne') $query->where('type', 'estheticienne');
        elseif ($type === 'institut')  $query->where('type', 'institut');

        $avis = $query->paginate(15)->withQueryString();

        $counts = [
            'en_attente' => Avis::where('statut', 'en_attente')->count(),
            'publies'    => Avis::where('statut', 'publie')->count(),
            'refuses'    => Avis::where('statut', 'refuse')->count(),
        ];

        return view('admin.avis.index', compact('avis', 'filtre', 'type', 'counts'));
    }

    public function approuver(Avis $avi): RedirectResponse
    {
        $avi->update(['statut' => 'publie', 'motif_refus' => null]);

        // Notifier le client
        try {
            $avi->client->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'avis_approuve',
                'data'    => json_encode([
                    'message' => '✅  Your review has been approved and published.',
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {}

        return back()->with('success', 'Review approved and published.');
    }

    public function refuser(Request $request, Avis $avi): RedirectResponse
    {
        $request->validate([
            'motif_refus' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $avi->update([
            'statut'      => 'refuse',
            'motif_refus' => $request->motif_refus,
        ]);

        // Notifier le client
        try {
            $avi->client->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'avis_refuse',
                'data'    => json_encode([
                    'message' => "❌ Your review has been rejected. Reason: {$request->motif_refus}",
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {}

        return back()->with('success', 'Review rejected.');
    }
}
