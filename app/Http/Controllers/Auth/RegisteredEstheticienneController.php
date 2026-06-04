<?php

namespace App\Http\Controllers\Auth;

use App\Mail\OtpInscription;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstheticienneRegisterRequest;
use App\Models\RegistrationOtp;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisteredEstheticienneController extends Controller
{
    // ── Étape 1 : Formulaire inscription ─────────────────────────────────
    public function create(): View
    {
        return view('auth.register-esthe');
    }

    // ── Étape 2 : Valider + envoyer OTP ──────────────────────────────────
    public function store(EstheticienneRegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Générer OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Supprimer ancien OTP si existe
        RegistrationOtp::where('email', $data['email'])->delete();

        // Sauvegarder OTP
        RegistrationOtp::create([
            'email'      => $data['email'],
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Sauvegarder données en session
        session([
            'register_esthe_data' => [
                'nom'         => $data['nom'],
                'prenom'      => $data['prenom'],
                'email'       => $data['email'],
                'telephone'   => $data['telephone'],
                'experience'  => $data['experience'],
                'specialites' => $data['specialites'],
                'password'    => $data['password'],
            ]
        ]);

        // Envoyer OTP
        try {
            Mail::to($data['email'])->send(new OtpInscription($otp, $data['prenom']));
        } catch (\Exception $e) {
            \Log::error('OTP esthe inscription: ' . $e->getMessage());
        }

        return redirect()->route('register.esthe.verify.otp')
            ->with('success', 'Un code de vérification a été envoyé à ' . $data['email']);
    }

    // ── Étape 3 : Formulaire vérification OTP ────────────────────────────
    public function showVerifyOtp(): View|RedirectResponse
    {
        if (!session('register_esthe_data')) {
            return redirect()->route('register.estheticienne');
        }
        return view('auth.verify-otp-esthe');
    }

    // ── Étape 4 : Vérifier OTP + créer compte ────────────────────────────
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $data = session('register_esthe_data');
        if (!$data) {
            return redirect()->route('register.estheticienne')->withErrors(['otp' => 'Session expirée. Réessayez.']);
        }

        $otpRecord = RegistrationOtp::where('email', $data['email'])
            ->where('otp', $request->otp)
            ->first();

        if (!$otpRecord || $otpRecord->estExpire()) {
            return back()->withErrors(['otp' => 'Code incorrect ou expiré. Réessayez.']);
        }

        // Créer le compte esthéticienne
        $user = User::create([
            'nom'           => $data['nom'],
            'prenom'        => $data['prenom'],
            'email'         => $data['email'],
            'telephone'     => $data['telephone'],
            'experience'    => $data['experience'],
            'specialites'   => $data['specialites'],
            'password'      => Hash::make($data['password']),
            'role'          => 'estheticienne',
            'statut_compte' => 'en_attente_validation',
            'email_verified_at' => now(),
        ]);

        // Notifier l'admin
        try {
            $admin = \App\Models\User::where('role', 'admin')->first();
            $admin?->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'nouvelle_inscription_esthe',
                'data'    => json_encode([
                    'message' => "👩‍🎨 Nouvelle demande d'inscription esthéticienne : {$user->fullName()}",
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {}

        // Nettoyer
        RegistrationOtp::where('email', $data['email'])->delete();
        session()->forget('register_esthe_data');

        return redirect()->route('login')
            ->with('success', 'Email vérifié ✅ Votre demande a été enregistrée. Vous serez notifiée dès validation par l\'administrateur.');
    }

    // ── Renvoyer OTP ──────────────────────────────────────────────────────
    public function resendOtp(): RedirectResponse
    {
        $data = session('register_esthe_data');
        if (!$data) {
            return redirect()->route('register.estheticienne');
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        RegistrationOtp::where('email', $data['email'])->delete();
        RegistrationOtp::create([
            'email'      => $data['email'],
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        try {
            Mail::to($data['email'])->send(new OtpInscription($otp, $data['prenom']));
        } catch (\Exception $e) {}

        return back()->with('success', 'Nouveau code envoyé !');
    }
}
