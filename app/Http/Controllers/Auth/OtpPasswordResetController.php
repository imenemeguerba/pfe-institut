<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpResetPassword;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OtpPasswordResetController extends Controller
{
    public function showEmailForm(): View
    {
        return view('auth.otp.email');
    }

    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'No account found with this email address.',
        ]);

        $user = User::where('email', $request->email)->first();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Cache::put('otp_reset_' . $request->email, $otp, now()->addMinutes(10));

        Mail::to($request->email)->send(new OtpResetPassword($otp, $user->prenom));

        return redirect()->route('password.otp.verify', ['email' => $request->email])
            ->with('success', 'A verification code has been sent to your email.');
    }

    public function showVerifyForm(Request $request): View
    {
        return view('auth.otp.verify', ['email' => $request->query('email')]);
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required', 'string', 'size:6'],
        ]);

        $storedOtp = Cache::get('otp_reset_' . $request->email);

        if (!$storedOtp || $storedOtp !== $request->otp) {
            return back()->withErrors(['otp' => 'Incorrect or expired code. Please try again.']);
        }

        Cache::put('otp_verified_' . $request->email, true, now()->addMinutes(10));

        return redirect()->route('password.otp.reset', ['email' => $request->email]);
    }

    public function showResetForm(Request $request): View|RedirectResponse
    {
        $verified = Cache::get('otp_verified_' . $request->query('email'));

        if (!$verified) {
            return redirect()->route('password.otp.email')
                ->withErrors(['email' => 'Session expired. Please start again.']);
        }

        return view('auth.otp.reset', ['email' => $request->query('email')]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email'                 => ['required', 'email', 'exists:users,email'],
            'password'              => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ], [
            'password.min'       => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        $verified = Cache::get('otp_verified_' . $request->email);

        if (!$verified) {
            return redirect()->route('password.otp.email')
                ->withErrors(['email' => 'Session expired. Please start again.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        Cache::forget('otp_reset_' . $request->email);
        Cache::forget('otp_verified_' . $request->email);

        return redirect()->route('login')
            ->with('status', 'Password changed successfully! You can now sign in.');
    }
}
