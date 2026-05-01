<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Demande de suppression — {{ $demande->user->fullName() }}
            </h2>
            <a href="{{ route('admin.demandes-suppression.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                ← Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

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

            {{-- Statut --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <p class="text-sm text-gray-500">Statut de la demande</p>
                @if ($demande->statut === 'en_attente')
                    <p class="text-2xl font-bold text-orange-600">⏳ En attente de traitement</p>
                @elseif ($demande->statut === 'acceptee')
                    <p class="text-2xl font-bold text-green-600">✅ Acceptée</p>
                    @if ($demande->date_traitement)
                        <p class="text-sm text-gray-500 mt-1">Traitée le {{ $demande->date_traitement->format('d/m/Y à H:i') }}</p>
                    @endif
                @else
                    <p class="text-2xl font-bold text-red-600">❌ Refusée</p>
                    @if ($demande->motif_refus)
                        <p class="mt-2 text-sm text-gray-700"><strong>Motif :</strong> {{ $demande->motif_refus }}</p>
                    @endif
                @endif
            </div>

            {{-- Infos utilisateur --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Informations utilisateur</h3>
                <dl class="space-y-2">
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Nom complet</dt>
                        <dd class="text-sm font-medium">{{ $demande->user->fullName() }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Email</dt>
                        <dd class="text-sm font-medium">{{ $demande->user->email }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Téléphone</dt>
                        <dd class="text-sm font-medium">{{ $demande->user->telephone }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Rôle</dt>
                        <dd class="text-sm font-medium">{{ $demande->user->isClient() ? 'Client' : 'Esthéticienne' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Demande envoyée le</dt>
                        <dd class="text-sm font-medium">{{ $demande->created_at->format('d/m/Y à H:i') }}</dd>
                    </div>
                </dl>

                @if ($demande->motif_demande)
                    <div class="mt-4 p-3 bg-gray-50 rounded">
                        <p class="text-sm text-gray-500">Motif donné par l'utilisateur :</p>
                        <p class="text-sm text-gray-800 mt-1">{{ $demande->motif_demande }}</p>
                    </div>
                @endif
            </div>

            {{-- Vérification RDV futurs --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Vérification automatique : rendez-vous à venir</h3>

                @if ($rdvFuturs->isEmpty())
                    <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded">
                        <p class="text-sm text-green-800">
                            ✅ Aucun rendez-vous à venir. La suppression est possible.
                        </p>
                    </div>
                @else
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded mb-4">
                        <p class="text-sm text-red-800">
                            ⚠️ {{ $rdvFuturs->count() }} rendez-vous à venir. La suppression n'est pas possible. Veuillez refuser cette demande.
                        </p>
                    </div>

                    <ul class="space-y-2">
                        @foreach ($rdvFuturs as $rdv)
                            <li class="text-sm text-gray-700 border-l-2 border-gray-300 pl-3">
                                <strong>{{ $rdv->date_debut->format('d/m/Y à H:i') }}</strong>
                                @if ($demande->user->isClient())
                                    — avec {{ $rdv->estheticienne->fullName() }}
                                @else
                                    — pour {{ $rdv->client->fullName() }}
                                @endif
                                <span class="text-gray-500">({{ $rdv->libelleStatut() }})</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Actions admin (uniquement si en attente) --}}
            @if ($demande->estEnAttente())
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Décision</h3>

                    <div class="flex gap-3">
                        {{-- Accepter --}}
                        <form action="{{ route('admin.demandes-suppression.accepter', $demande) }}" method="POST"
                              onsubmit="return confirm('⚠️ Accepter cette demande supprimera définitivement le compte. Continuer ?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    @if($rdvFuturs->isNotEmpty()) disabled @endif
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm font-medium disabled:bg-gray-400 disabled:cursor-not-allowed">
                                ✅ Accepter et supprimer le compte
                            </button>
                        </form>

                        {{-- Refuser (modal) --}}
                        <button type="button" onclick="document.getElementById('modal-refuser').classList.remove('hidden')"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm font-medium">
                            ❌ Refuser
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Modal refus --}}
    @if ($demande->estEnAttente())
        <div id="modal-refuser" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                <h3 class="text-lg font-semibold mb-4">Refuser la demande</h3>
                <form action="{{ route('admin.demandes-suppression.refuser', $demande) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Motif du refus *</label>
                        <textarea name="motif_refus" rows="3" required minlength="10" maxlength="500"
                                  class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Ex : Vous avez 2 RDV à venir. Veuillez les annuler avant de soumettre une nouvelle demande."></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('modal-refuser').classList.add('hidden')"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 text-sm">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                            Confirmer le refus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</x-app-layout>
