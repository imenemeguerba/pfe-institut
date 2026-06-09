<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CompteActionClient;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(Request $request): View
    {
        $filtre = $request->query('filtre', 'tous');
        $search = $request->query('search', '');

        $query = User::clients()->nonSupprimes()->orderByDesc('created_at');

        if ($filtre === 'actifs') {
            $query->actifs();
        } elseif ($filtre === 'bloques') {
            $query->bloques();
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('prenom', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('telephone', 'like', '%' . $search . '%');
            });
        }

        $clients = $query->paginate(15)->withQueryString();

        $compteurs = [
            'tous'    => User::clients()->nonSupprimes()->count(),
            'actifs'  => User::clients()->actifs()->count(),
            'bloques' => User::clients()->bloques()->count(),
        ];

        return view('admin.clients.index', compact('clients', 'filtre', 'search', 'compteurs'));
    }

    public function show(User $client): View
    {
        if (!$client->isClient()) abort(404);

        $rdvFuturs = $client->rendezVous()
            ->where('date_debut', '>=', now())
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->with('estheticienne')
            ->orderBy('date_debut')
            ->get();

        $rdvPasses = $client->rendezVous()
            ->where('date_debut', '<', now())
            ->with('estheticienne')
            ->orderByDesc('date_debut')
            ->limit(5)
            ->get();

        $stats = [
            'total_rdv'       => $client->rendezVous()->count(),
            'total_commandes' => $client->commandes()->count(),
            'total_avis'      => $client->avis()->count(),
        ];

        return view('admin.clients.show', compact('client', 'rdvFuturs', 'rdvPasses', 'stats'));
    }

    public function bloquer(Request $request, User $client): RedirectResponse
    {
        if (!$client->isClient() || !$client->estActif()) {
            return back()->with('error', 'This client account is not active.');
        }

        $request->validate([
            'motif' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $client->update([
            'statut_compte'  => 'bloque',
            'motif_statut'   => $request->input('motif'),
            'email_libre_le' => null, // ✅ Not a permanent ban — can be unblocked
        ]);

        try {
            Mail::to($client->email)->send(new CompteActionClient(
                prenom: $client->prenom,
                action: 'bloque',
                motif:  $request->motif ?? null,
            ));
        } catch (\Exception $e) {
            \Log::error('Email bloquer client: ' . $e->getMessage());
        }

        return redirect()->route('admin.clients.show', $client)
            ->with('success', $client->fullName() . ' has been blocked.');
    }

    public function debloquer(User $client): RedirectResponse
    {
        if (!$client->isClient() || !$client->estBloque()) {
            return back()->with('error', 'This client account is not blocked.');
        }

        $client->update([
            'statut_compte'  => 'actif',
            'motif_statut'   => null,
            'email_libre_le' => null,
        ]);

        // ✅ Email notification added
        try {
            Mail::to($client->email)->send(new CompteActionClient(
                prenom: $client->prenom,
                action: 'reactive',
            ));
        } catch (\Exception $e) {
            \Log::error('Email debloquer client: ' . $e->getMessage());
        }

        return redirect()->route('admin.clients.show', $client)
            ->with('success', $client->fullName() . ' has been unblocked.');
    }

    public function destroy(User $client): RedirectResponse
    {
        if (!$client->isClient()) abort(404);

        $rdvFuturs = $client->rendezVous()
            ->where('date_debut', '>=', now())
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->count();

        if ($rdvFuturs > 0) {
            return back()->with('error',
                'Cannot delete: ' . $client->fullName() . ' has ' . $rdvFuturs . ' upcoming appointment(s).'
            );
        }

        $nom    = $client->fullName();
        $email  = $client->email;
        $prenom = $client->prenom;

        try {
            Mail::to($email)->send(new CompteActionClient(
                prenom: $prenom,
                action: 'supprime',
            ));
        } catch (\Exception $e) {
            \Log::error('Email supprimer client: ' . $e->getMessage());
        }

        $client->update([
            'statut_compte'  => 'supprime',
            'motif_statut'   => 'Account deleted by administrator',
            'email_libre_le' => '9999-12-31 23:59:59',
        ]);

        return redirect()->route('admin.clients.index')
            ->with('success', 'The account of ' . $nom . ' has been deleted.');
    }
}
