<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CodePromoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        $codeId = $this->route('code_promo')?->id;

        return [
            'code' => ['required', 'string', 'max:50', Rule::unique('codes_promo', 'code')->ignore($codeId)],
            'description' => ['nullable', 'string', 'max:500'],
            'type_reduction' => ['required', 'in:pourcentage,montant'],
            'valeur' => ['required', 'integer', 'min:1'],
            'applicable_a' => ['required', 'in:services,produits,les_deux'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after:date_debut'],
            'limite_utilisation' => ['nullable', 'integer', 'min:1'],
            'actif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Le code est obligatoire.',
            'code.unique' => 'Ce code est déjà utilisé.',
            'type_reduction.required' => 'Le type de réduction est obligatoire.',
            'valeur.required' => 'La valeur de la réduction est obligatoire.',
            'valeur.min' => 'La valeur doit être supérieure à 0.',
            'applicable_a.required' => 'Veuillez choisir à quoi le code s\'applique.',
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.after' => 'La date de fin doit être après la date de début.',
            'limite_utilisation.min' => 'La limite doit être au moins 1.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'actif' => $this->has('actif'),
            'code' => strtoupper($this->input('code', '')),
        ]);
    }
}
