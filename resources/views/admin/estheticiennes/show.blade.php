<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $estheticienne->fullName() }}
            </h2>
            <a href="{{ route('admin.estheticiennes.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                ← Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Messages flash --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Statut actuel + actions principales --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Statut du compte</p>
                        @if ($estheticienne->statut_compte === 'en_attente_validation')
                            <p class="text-2xl font-bold text-orange-600">⏳ En attente de validation</p>
                        @elseif ($estheticienne->statut_compte === 'actif')
                            <p class="text-2xl font-bold text-green-600">✅ Compte actif</p>
                        @elseif ($estheticienne->statut_compte === 'desactive')
                            <p class="text-2xl font-bold text-gray-600">🚫 Compte désactivé</p>
                        @endif

                        @if ($estheticienne->motif_statut)
                            <p class="mt-2 text-sm text-gray-600 italic">Motif : {{ $estheticienne->motif_statut }}</p>
                        @endif
                    </div>

                    {{-- Actions selon statut --}}
                    <div class="flex gap-2">
                        @if ($estheticienne->estEnAttenteValidation())
                            {{-- Accepter --}}
                            <form action="{{ route('admin.estheticiennes.accepter', $estheticienne) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm font-medium">
                                    ✅ Accepter
                                </button>
                            </form>

                            {{-- Refuser --}}
                            <form action="{{ route('admin.estheticiennes.refuser', $estheticienne) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Refuser cette demande ? Le compte sera supprimé.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm font-medium">
                                    ❌ Refuser
                                </button>
                            </form>
                        @endif

                        @if ($estheticienne->estActif())
                            <button type="button" onclick="document.getElementById('modal-desactiver').classList.remove('hidden')"
                                    class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 text-sm font-medium">
                                🚫 Désactiver
                            </button>
                        @endif

                        @if ($estheticienne->statut_compte === 'desactive')
                            <form action="{{ route('admin.estheticiennes.reactiver', $estheticienne) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm font-medium">
                                    ✅ Réactiver
                                </button>
                            </form>
                        @endif

                        {{-- Supprimer (uniquement si actif ou désactivé, pas si en attente) --}}
                        @if (in_array($estheticienne->statut_compte, ['actif', 'desactive']))
                            <form action="{{ route('admin.estheticiennes.destroy', $estheticienne) }}" method="POST" class="inline"
                                  onsubmit="return confirm('⚠️ ATTENTION : Supprimer définitivement ce compte ?\n\nCette action est irréversible. Toutes les données de cette esthéticienne seront supprimées.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 text-sm font-medium">
                                    🗑️ Supprimer définitivement
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Informations personnelles --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Informations personnelles</h3>
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Nom</dt>
                            <dd class="text-sm font-medium">{{ $estheticienne->nom }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Prénom</dt>
                            <dd class="text-sm font-medium">{{ $estheticienne->prenom }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Email</dt>
                            <dd class="text-sm font-medium">{{ $estheticienne->email }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Téléphone</dt>
                            <dd class="text-sm font-medium">{{ $estheticienne->telephone }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500">Inscrite le</dt>
                            <dd class="text-sm font-medium">{{ $estheticienne->created_at->format('d/m/Y à H:i') }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Profil professionnel</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm text-gray-500">Expérience</dt>
                            <dd class="text-sm font-medium">{{ $estheticienne->experience }} année(s)</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Spécialités déclarées</dt>
                            <dd class="text-sm font-medium mt-1 p-3 bg-gray-50 rounded">{{ $estheticienne->specialites }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Services associés (uniquement si compte actif) --}}
            @if ($estheticienne->estActif())
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Services maîtrisés</h3>
                    <p class="text-sm text-gray-600 mb-4">Cochez les services que cette esthéticienne peut réaliser :</p>

                    <form action="{{ route('admin.estheticiennes.services', $estheticienne) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        @if ($services->isEmpty())
                            <p class="text-gray-500 italic">Aucun service disponible. Créez d'abord des services.</p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-4">
                                @foreach ($services as $service)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                               {{ $estheticienne->servicesProposes->contains($service->id) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">
                                            {{ $service->nom }}
                                            <span class="text-xs text-gray-500">({{ $service->category->nom }})</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 text-sm font-medium">
                                    Enregistrer les services
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            @endif

        </div>
    </div>

    {{-- Modal désactivation --}}
    @if ($estheticienne->estActif())
        <div id="modal-desactiver" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                <h3 class="text-lg font-semibold mb-4">Désactiver le compte</h3>
                <form action="{{ route('admin.estheticiennes.desactiver', $estheticienne) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Motif de désactivation *</label>
                        <textarea name="motif" rows="3" required minlength="5" maxlength="500"
                                  class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Ex : Absence prolongée..."></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('modal-desactiver').classList.add('hidden')"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 text-sm">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 text-sm">
                            Confirmer la désactivation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</x-app-layout>
