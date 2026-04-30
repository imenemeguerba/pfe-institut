<x-guest-layout>
    {{-- Message de présentation --}}
    <div class="mb-6 p-4 bg-pink-50 border-l-4 border-pink-400 rounded">
        <p class="text-sm text-gray-700">
            <strong>Espace professionnel</strong><br>
            Votre demande sera examinée par notre administrateur. Vous recevrez une notification dès la validation de votre compte.
        </p>
    </div>

    <form method="POST" action="{{ route('register.esthe') }}">
        @csrf

        {{-- Nom --}}
        <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="family-name" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        {{-- Prénom --}}
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autocomplete="given-name" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div class="mt-4">
            <x-input-label for="email" :value="__('Adresse email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Téléphone --}}
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Numéro de téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" :value="old('telephone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        {{-- Expérience --}}
        <div class="mt-4">
            <x-input-label for="experience" :value="__('Années d\'expérience')" />
            <x-text-input id="experience" class="block mt-1 w-full" type="number" name="experience" :value="old('experience')" required min="0" max="60" />
            <x-input-error :messages="$errors->get('experience')" class="mt-2" />
        </div>

        {{-- Spécialités --}}
        <div class="mt-4">
            <x-input-label for="specialites" :value="__('Vos spécialités')" />
            <textarea id="specialites" name="specialites" rows="4" required minlength="10" maxlength="1000"
                      class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                      placeholder="Ex : Soins du visage, manucure, maquillage, massages...">{{ old('specialites') }}</textarea>
            <p class="mt-1 text-xs text-gray-500">Décrivez vos compétences (10 caractères minimum, 1000 maximum).</p>
            <x-input-error :messages="$errors->get('specialites')" class="mt-2" />
        </div>

        {{-- Mot de passe --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirmation mot de passe --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Boutons --}}
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà un compte ?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Soumettre ma demande') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
