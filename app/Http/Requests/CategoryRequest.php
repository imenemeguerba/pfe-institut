<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        // Le middleware 'admin' a déjà fait la vérification, donc on autorise
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
            'nom' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'actif' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 100 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format JPG, PNG ou WebP.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }

    /**
     * Préparer les données avant validation.
     */
    protected function prepareForValidation(): void
    {
        // La case "actif" non cochée n'envoie pas de valeur, on met false par défaut
        $this->merge([
            'actif' => $this->has('actif'),
        ]);
    }
}
