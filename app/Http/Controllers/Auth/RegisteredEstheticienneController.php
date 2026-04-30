<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstheticienneRegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredEstheticienneController extends Controller
{
    /**
     * Affiche le formulaire d'inscription esthéticienne.
     */
    public function create(): View
    {
        return view('auth.register-esthe');
    }

    /**
     * Enregistre une nouvelle demande d'inscription esthéticienne.
     */
    public function store(EstheticienneRegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Créer le compte avec statut "en attente de validation"
        User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'experience' => $data['experience'],
            'specialites' => $data['specialites'],
            'password' => Hash::make($data['password']),
            'role' => 'estheticienne',
            'statut_compte' => 'en_attente_validation',
        ]);

        // ⚠️ On ne connecte PAS l'esthéticienne automatiquement
        // Elle doit attendre la validation de l'admin

        return redirect()
            ->route('login')
            ->with('success', 'Votre demande d\'inscription a bien été enregistrée. Vous recevrez une notification dès que votre compte sera validé par l\'administrateur.');
    }
}
