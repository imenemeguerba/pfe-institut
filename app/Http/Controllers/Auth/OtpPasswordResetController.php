<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OtpPasswordResetController extends Controller
{
    // ── Étape 1 : Formulaire email ────────────────────────────────────────
    public function showEmailForm(): View
    {
        return view('auth.otp.email');
    }

    // ── Étape 2 : Envoyer l'OTP ───────────────────────────────────────────
    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Aucun compte associé à cet email.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Générer OTP 6 chiffres
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Stocker dans cache (valide 10 minutes)
        Cache::put('otp_reset_' . $request->email, $otp, now()->addMinutes(10));

        // Envoyer l'email
        Mail::to($request->email)->send(new OtpResetPassword($otp, $user->prenom));

        return redirect()->route('password.otp.verify', ['email' => $request->email])
            ->with('success', 'Un code de vérification a été envoyé à votre email.');
    }

    // ── Étape 3 : Formulaire vérification OTP ────────────────────────────
    public function showVerifyForm(Request $request): View
    {
        return view('auth.otp.verify', ['email' => $request->query('email')]);
    }

    // ── Étape 4 : Vérifier l'OTP ─────────────────────────────────────────
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required', 'string', 'size:6'],
        ]);

        $storedOtp = Cache::get('otp_reset_' . $request->email);

        if (!$storedOtp || $storedOtp !== $request->otp) {
            return back()->withErrors(['otp' => 'Code incorrect ou expiré. Réessayez.']);
        }

        // OTP valide → autoriser le reset
        Cache::put('otp_verified_' . $request->email, true, now()->addMinutes(10));

        return redirect()->route('password.otp.reset', ['email' => $request->email]);
    }

    // ── Étape 5 : Formulaire nouveau mot de passe ─────────────────────────
    public function showResetForm(Request $request): View|RedirectResponse
    {
        $verified = Cache::get('otp_verified_' . $request->query('email'));

        if (!$verified) {
            return redirect()->route('password.otp.email')
                ->withErrors(['email' => 'Session expirée. Recommencez.']);
        }

        return view('auth.otp.reset', ['email' => $request->query('email')]);
    }

    // ── Étape 6 : Sauvegarder le nouveau mot de passe ────────────────────
    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email'                 => ['required', 'email', 'exists:users,email'],
            'password'              => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ], [
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        $verified = Cache::get('otp_verified_' . $request->email);

        if (!$verified) {
            return redirect()->route('password.otp.email')
                ->withErrors(['email' => 'Session expirée. Recommencez.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        // Nettoyer le cache
        Cache::forget('otp_reset_' . $request->email);
        Cache::forget('otp_verified_' . $request->email);

        return redirect()->route('login')
            ->with('status', 'Mot de passe modifié avec succès ! Connectez-vous.');
    }
}
