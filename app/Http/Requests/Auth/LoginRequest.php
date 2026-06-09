<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // ✅ FIX: check account status BEFORE Auth::attempt()
        // withoutGlobalScopes() bypasses any active-only scope on User model
        $user = User::withoutGlobalScopes()
            ->where('email', $this->string('email'))
            ->first();

        if ($user) {
            if ($user->statut_compte === 'supprime') {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'email' => 'This account no longer exists.',
                ]);
            }

            if ($user->statut_compte === 'en_attente_validation') {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'email' => 'Your account is pending validation by the administrator. You will be notified once it is activated.',
                ]);
            }

            if ($user->statut_compte === 'desactive') {
                $motif = $user->motif_statut ? ' Reason: ' . $user->motif_statut : '';
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'email' => 'Your account has been deactivated.' . $motif,
                ]);
            }

            if ($user->statut_compte === 'bloque') {
                $motif = $user->motif_statut ? ' Reason: ' . $user->motif_statut : '';
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'email' => 'Your account has been blocked.' . $motif,
                ]);
            }
        }

        // ✅ FIX: hardcoded English instead of __('auth.failed') which uses app locale
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => 'Too many login attempts. Please try again in ' . ceil($seconds / 60) . ' minute(s).',
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
