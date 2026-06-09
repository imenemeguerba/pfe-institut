<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailDisponiblePourInscription implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where('email', $value)->first();

        if (!$user) {
            return; // Email available
        }

        if ($user->statut_compte !== 'supprime') {
            $fail('This email address is already in use.');
            return;
        }

        // Account is marked as deleted — check cooldown
        if ($user->email_libre_le && $user->email_libre_le->isFuture()) {

            // Permanent ban (admin manually deleted)
            if ($user->email_libre_le->year >= 9999) {
                $fail('This email address cannot be used.');
                return;
            }

            // Temporary cooldown (refused registration)
            $fail('This email address is not yet available. You can try again from '
                . $user->email_libre_le->format('d/m/Y') . '.');
            return;
        }

        // Cooldown expired → free the email by removing the ghost account
        $user->delete();
    }
}
