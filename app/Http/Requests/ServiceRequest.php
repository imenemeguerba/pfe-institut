<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    /**
     * Les règles de validation.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'nom' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'prix' => ['required', 'integer', 'min:0'],
            'duree' => ['required', 'integer', 'min:5', 'max:480'],
            'actif' => ['nullable', 'boolean'],
            'estheticiennes' => ['nullable', 'array'],
            'estheticiennes.*' => ['exists:users,id'],
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Veuillez choisir une catégorie.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'nom.required' => 'Le nom du service est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 150 caractères.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.integer' => 'Le prix doit être un nombre entier.',
            'prix.min' => 'Le prix ne peut pas être négatif.',
            'duree.required' => 'La durée est obligatoire.',
            'duree.integer' => 'La durée doit être un nombre entier.',
            'duree.min' => 'La durée minimum est de 5 minutes.',
            'duree.max' => 'La durée maximum est de 8 heures (480 minutes).',
            'image.mimes' => 'L\'image doit être au format JPG, PNG ou WebP.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }

    /**
     * Préparer les données avant validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'actif' => $this->has('actif'),
        ]);
    }
}