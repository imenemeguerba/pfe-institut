<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouveau service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Catégorie --}}
                    <div class="mb-6">
                        <x-input-label for="category_id" :value="__('Catégorie *')" />
                        <select id="category_id" name="category_id" required class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">— Choisir une catégorie —</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nom }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                    </div>

                    {{-- Nom --}}
                    <div class="mb-6">
                        <x-input-label for="nom" :value="__('Nom du service *')" />
                        <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nom')" />
                    </div>

                    {{-- Description --}}
                    <div class="mb-6">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    {{-- Prix + Durée (côte à côte) --}}
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <x-input-label for="prix" :value="__('Prix (DA) *')" />
                            <x-text-input id="prix" name="prix" type="number" min="0" step="100" class="mt-1 block w-full" :value="old('prix')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('prix')" />
                        </div>
                        <div>
                            <x-input-label for="duree" :value="__('Durée (minutes) *')" />
                            <x-text-input id="duree" name="duree" type="number" min="5" max="480" step="5" class="mt-1 block w-full" :value="old('duree')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('duree')" />
                        </div>
                    </div>

                    {{-- Image --}}
                    <div class="mb-6">
                        <x-input-label for="image" :value="__('Image (optionnelle)')" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG ou WebP. Max 2 Mo.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>

                    {{-- Esthéticiennes --}}
                    <div class="mb-6">
                        <x-input-label :value="__('Esthéticiennes qui maîtrisent ce service')" />
                        @if ($estheticiennes->isEmpty())
                            <p class="mt-2 text-sm text-gray-500 italic">
                                Aucune esthéticienne active pour l'instant. Vous pouvez créer le service et associer les esthéticiennes plus tard.
                            </p>
                        @else
                            <div class="mt-2 grid grid-cols-2 gap-2 border border-gray-200 rounded-md p-4">
                                @foreach ($estheticiennes as $esthe)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="estheticiennes[]" value="{{ $esthe->id }}" 
                                               {{ in_array($esthe->id, old('estheticiennes', [])) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-600">{{ $esthe->fullName() }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                        <x-input-error class="mt-2" :messages="$errors->get('estheticiennes')" />
                    </div>

                    {{-- Actif --}}
                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="actif" value="1" {{ old('actif', true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-600">Service actif (visible aux clients)</span>
                        </label>
                    </div>

                    {{-- Boutons --}}
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.services.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">
                            Annuler
                        </a>
                        <x-primary-button>
                            {{ __('Créer le service') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>