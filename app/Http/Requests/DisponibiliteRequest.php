<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DisponibiliteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isEstheticienne();
    }

    public function rules(): array
    {
        return [
            'jour_semaine' => ['required', 'integer', 'min:1', 'max:7'],
            'heure_debut' => ['required', 'date_format:H:i'],
            'heure_fin' => ['required', 'date_format:H:i', 'after:heure_debut'],
        ];
    }

    public function messages(): array
    {
        return [
            'jour_semaine.required' => 'Le jour est obligatoire.',
            'jour_semaine.min' => 'Jour invalide.',
            'jour_semaine.max' => 'Jour invalide.',
            'heure_debut.required' => 'L\'heure de début est obligatoire.',
            'heure_debut.date_format' => 'Format d\'heure incorrect (HH:MM).',
            'heure_fin.required' => 'L\'heure de fin est obligatoire.',
            'heure_fin.date_format' => 'Format d\'heure incorrect (HH:MM).',
            'heure_fin.after' => 'L\'heure de fin doit être après l\'heure de début.',
        ];
    }
}
