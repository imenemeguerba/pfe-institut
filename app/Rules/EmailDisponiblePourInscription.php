<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailDisponiblePourInscription implements ValidationRule
{
    /**
     * Vérifie qu'un email est utilisable pour une nouvelle inscription.
     *
     * Logique :
     * - Si l'email n'existe pas → ✅ disponible
     * - Si l'email existe avec statut != 'supprime' → ❌ déjà utilisé
     * - Si l'email existe avec statut 'supprime' :
     *     - email_libre_le NULL ou passé → ✅ disponible (on supprime l'ancien compte)
     *     - email_libre_le futur → ❌ encore réservé
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where('email', $value)->first();

        if (!$user) {
            return; // Email libre
        }

        if ($user->statut_compte !== 'supprime') {
            $fail('Cette adresse email est déjà utilisée.');
            return;
        }

        // L'utilisateur est marqué comme supprimé
        if ($user->email_libre_le && $user->email_libre_le->isFuture()) {
            $fail('Cette adresse email n\'est pas encore disponible. Elle pourra être réutilisée le '
                . $user->email_libre_le->format('d/m/Y') . '.');
            return;
        }

        // Email banni à vie (date 9999) ou pas de date → on regarde la date
        if ($user->email_libre_le && $user->email_libre_le->year >= 9999) {
            $fail('Cette adresse email ne peut pas être utilisée.');
            return;
        }

        // Email libéré : on supprime l'ancien compte fantôme pour libérer l'email
        $user->delete();
    }
}
