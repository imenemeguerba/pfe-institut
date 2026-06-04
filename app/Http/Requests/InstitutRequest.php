<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InstitutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'email' => ['required', 'string', 'email', 'max:150'],
            'telephone' => ['required', 'string', 'max:20'],
            'adresse' => ['required', 'string', 'max:255'],
            'ville' => ['nullable', 'string', 'max:100'],
            'code_postal' => ['nullable', 'string', 'max:10'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'facebook' => ['nullable', 'string', 'url', 'max:255'],
            'instagram' => ['nullable', 'string', 'url', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'taux_tva' => ['required', 'numeric', 'min:0', 'max:100'],
            'seuil_affluence_eleve' => ['required', 'integer', 'min:1'],
            'seuil_affluence_moyen' => ['required', 'integer', 'min:1', 'lt:seuil_affluence_eleve'],
            'horaires' => ['nullable', 'array'],
            'latitude'  => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de l\'institut est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'telephone.required' => 'Le téléphone est obligatoire.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'logo.image' => 'Le logo doit être une image.',
            'logo.max' => 'Le logo ne doit pas dépasser 2 Mo.',
            'facebook.url' => 'Le lien Facebook doit être une URL valide.',
            'instagram.url' => 'Le lien Instagram doit être une URL valide.',
            'taux_tva.required' => 'Le taux de TVA est obligatoire.',
            'taux_tva.numeric' => 'Le taux de TVA doit être un nombre.',
            'seuil_affluence_eleve.required' => 'Le seuil d\'affluence élevée est obligatoire.',
            'seuil_affluence_moyen.required' => 'Le seuil d\'affluence moyenne est obligatoire.',
            'seuil_affluence_moyen.lt' => 'Le seuil moyen doit être inférieur au seuil élevé.',
        ];
    }
}
