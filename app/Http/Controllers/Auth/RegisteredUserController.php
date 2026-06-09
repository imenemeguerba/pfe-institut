<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpInscription;
use App\Models\RegistrationOtp;
use App\Models\User;
use App\Rules\EmailDisponiblePourInscription;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    // ── Étape 1 : Formulaire inscription ─────────────────────────────────
    public function create(): View
    {
        return view('auth.register');
    }

    // ── Étape 2 : Valider + envoyer OTP ──────────────────────────────────
    public function store(Request $request): RedirectResponse
    {
        // ✅ FIX: utiliser Validator::make pour contrôler la redirection
        $validator = Validator::make($request->all(), [
             'nom'            => ['required', 'string', 'max:100', 'regex:/^[a-zA-ZÀ-ÿ\s\-]+$/'],
             'prenom'         => ['required', 'string', 'max:100', 'regex:/^[a-zA-ZÀ-ÿ\s\-]+$/'],
             'date_naissance' => ['required', 'date', 'before:' . now()->subYears(18)->format('Y-m-d')],
             'telephone'      => ['required', 'string', 'regex:/^(05|06|07)[0-9]{8}$/'],
             'email'          => ['required', 'string', 'lowercase', 'email', 'max:255', new EmailDisponiblePourInscription()],
             'password'       => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'nom.required'            => 'Last name is required.',
            'nom.regex'               => 'Last name must contain letters only.',
            'prenom.required'         => 'First name is required.',
            'prenom.regex'            => 'First name must contain letters only.',
            'date_naissance.required' => 'Date of birth is required.',
            'date_naissance.before'   => 'You must be at least 18 years old.',
            'telephone.required'      => 'Phone number is required.',
            'telephone.regex'         => 'Phone number must start with 05, 06 or 07 followed by 8 digits.',
            'email.required'          => 'Email is required.',
            'email.email'             => 'Please enter a valid email address.',
            'password.required'       => 'Password is required.',
            'password.confirmed'      => 'Passwords do not match.',
        ]);

        // ✅ FIX: toujours rediriger vers route('register') — jamais back()
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput($request->except(['password', 'password_confirmation']));
        }

        // Générer OTP 6 chiffres
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Supprimer ancien OTP si existe
        RegistrationOtp::where('email', $request->email)->delete();

        // Sauvegarder OTP
        RegistrationOtp::create([
            'email'      => $request->email,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Sauvegarder données en session
        session([
            'register_data' => [
                'nom'            => $request->nom,
                'prenom'         => $request->prenom,
                'date_naissance' => $request->date_naissance,
                'telephone'      => $request->telephone,
                'email'          => $request->email,
                'password'       => $request->password,
            ]
        ]);

        // Envoyer OTP par email
        try {
            Mail::to($request->email)->send(new OtpInscription($otp, $request->prenom));
        } catch (\Exception $e) {
            \Log::error('OTP inscription: ' . $e->getMessage());
        }

        return redirect()->route('register.verify.otp')
            ->with('success', 'A verification code has been sent to ' . $request->email);
    }

    // ── Étape 3 : Formulaire vérification OTP ────────────────────────────
    public function showVerifyOtp(): View|RedirectResponse
    {
        if (!session('register_data')) {
            return redirect()->route('register');
        }
        return view('auth.verify-otp-register');
    }

    // ── Étape 4 : Vérifier OTP + créer compte ────────────────────────────
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $data = session('register_data');
        if (!$data) {
            return redirect()->route('register')->withErrors(['otp' => 'Session expired. Please try again.']);
        }

        $otpRecord = RegistrationOtp::where('email', $data['email'])
            ->where('otp', $request->otp)
            ->first();

        if (!$otpRecord || $otpRecord->estExpire()) {
            return back()->withErrors(['otp' => 'Incorrect or expired code. Please try again.']);
        }

        // Créer le compte
        $user = User::create([
            'nom'               => $data['nom'],
            'prenom'            => $data['prenom'],
            'date_naissance'    => $data['date_naissance'],
            'telephone'         => $data['telephone'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'role'              => 'client',
            'statut_compte'     => 'actif',
            'email_verified_at' => now(),
        ]);

        // Nettoyer
        RegistrationOtp::where('email', $data['email'])->delete();
        session()->forget('register_data');

        event(new Registered($user));
        Auth::login($user);

        // Email bienvenu
        try {
            Mail::to($user->email)->send(new \App\Mail\BienvenuClient($user->prenom));
        } catch (\Exception $e) {
            \Log::error('Email bienvenu: ' . $e->getMessage());
        }

        return redirect()->route('client.dashboard');
    }

    // ── Renvoyer OTP ──────────────────────────────────────────────────────
    public function resendOtp(): RedirectResponse
    {
        $data = session('register_data');
        if (!$data) {
            return redirect()->route('register');
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

        return back()->with('success', 'New verification code sent!');
    }
}
