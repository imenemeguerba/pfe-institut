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
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
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
        'category_id.required' => 'Please select a category.',
        'category_id.exists'   => 'The selected category does not exist.',
        'nom.required'         => 'Service name is required.',
        'nom.max'              => 'Service name cannot exceed 150 characters.',
        'prix.required'        => 'Price is required.',
        'prix.integer'         => 'Price must be a whole number.',
        'prix.min'             => 'Price cannot be negative.',
        'duree.required'       => 'Duration is required.',
        'duree.integer'        => 'Duration must be a whole number.',
        'duree.min'            => 'Minimum duration is 5 minutes.',
        'duree.max'            => 'Maximum duration is 8 hours (480 minutes).',
        'image.mimes'          => 'Image must be in JPG, PNG or WebP format.',
        'image.max'            => 'Image must not exceed 5 MB.',
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
