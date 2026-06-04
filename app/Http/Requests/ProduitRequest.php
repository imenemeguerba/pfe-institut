<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'nom'          => ['required', 'string', 'max:150'],
            'categorie_id' => ['nullable', 'integer', 'exists:categories_produits,id'],
            'description'  => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'prix'         => ['required', 'integer', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'seuil_alerte' => ['required', 'integer', 'min:0'],
            'actif'        => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required'         => 'Le nom du produit est obligatoire.',
            'nom.max'              => 'Le nom ne peut pas dépasser 150 caractères.',
            'prix.required'        => 'Le prix est obligatoire.',
            'prix.min'             => 'Le prix ne peut pas être négatif.',
            'stock.required'       => 'La quantité en stock est obligatoire.',
            'stock.min'            => 'Le stock ne peut pas être négatif.',
            'seuil_alerte.required'=> 'Le seuil d\'alerte est obligatoire.',
            'seuil_alerte.min'     => 'Le seuil d\'alerte ne peut pas être négatif.',
            'image.mimes'          => 'L\'image doit être au format JPG, PNG ou WebP.',
            'image.max'            => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['actif' => $this->has('actif')]);
    }
}
