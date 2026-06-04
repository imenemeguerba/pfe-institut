<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IndisponibiliteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isEstheticienne();
    }

    public function rules(): array
    {
        return [
            'date_debut' => ['required', 'date', 'after_or_equal:today'],
            'date_fin' => ['required', 'date', 'after:date_debut'],
            'type' => ['required', 'in:conge,maladie,formation,autre'],
            'motif' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_debut.after_or_equal' => 'La date de début doit être aujourd\'hui ou plus tard.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.after' => 'La date de fin doit être après la date de début.',
            'type.required' => 'Le type d\'indisponibilité est obligatoire.',
        ];
    }
}
