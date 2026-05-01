<?php

namespace App\Http\Requests;

use App\Rules\EmailDisponiblePourInscription;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class EstheticienneRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', new EmailDisponiblePourInscription()],
            'telephone' => ['required', 'string', 'max:20'],
            'experience' => ['required', 'integer', 'min:0', 'max:60'],
            'specialites' => ['required', 'string', 'min:10', 'max:1000'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être une adresse valide.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'experience.required' => 'Veuillez indiquer votre nombre d\'années d\'expérience.',
            'experience.integer' => 'L\'expérience doit être un nombre entier.',
            'experience.min' => 'L\'expérience ne peut pas être négative.',
            'experience.max' => 'L\'expérience ne peut pas dépasser 60 ans.',
            'specialites.required' => 'Veuillez décrire vos spécialités.',
            'specialites.min' => 'Veuillez décrire vos spécialités en au moins 10 caractères.',
            'specialites.max' => 'La description des spécialités ne peut pas dépasser 1000 caractères.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ];
    }
}
