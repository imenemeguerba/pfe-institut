<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Demandes de suppression de compte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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

            {{-- Onglets --}}
            <div class="bg-white shadow-sm rounded-lg mb-6 overflow-hidden">
                <div class="flex border-b border-gray-200">
                    <a href="{{ route('admin.demandes-suppression.index', ['filtre' => 'en_attente']) }}"
                       class="px-6 py-4 text-sm font-medium border-b-2 transition {{ $filtre === 'en_attente' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        ⏳ En attente
                        @if ($compteurs['en_attente'] > 0)
                            <span class="ml-1 inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                {{ $compteurs['en_attente'] }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('admin.demandes-suppression.index', ['filtre' => 'acceptees']) }}"
                       class="px-6 py-4 text-sm font-medium border-b-2 transition {{ $filtre === 'acceptees' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        ✅ Acceptées <span class="ml-1 text-xs text-gray-500">({{ $compteurs['acceptees'] }})</span>
                    </a>
                    <a href="{{ route('admin.demandes-suppression.index', ['filtre' => 'refusees']) }}"
                       class="px-6 py-4 text-sm font-medium border-b-2 transition {{ $filtre === 'refusees' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        ❌ Refusées <span class="ml-1 text-xs text-gray-500">({{ $compteurs['refusees'] }})</span>
                    </a>
                    <a href="{{ route('admin.demandes-suppression.index', ['filtre' => 'toutes']) }}"
                       class="px-6 py-4 text-sm font-medium border-b-2 transition {{ $filtre === 'toutes' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        📋 Toutes <span class="ml-1 text-xs text-gray-500">({{ $compteurs['toutes'] }})</span>
                    </a>
                </div>
            </div>

            {{-- Tableau --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Demandé le</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($demandes as $demande)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $demande->user->fullName() }}</div>
                                    <div class="text-xs text-gray-500">{{ $demande->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if ($demande->user->isClient())
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Client</span>
                                    @elseif ($demande->user->isEstheticienne())
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Esthéticienne</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if ($demande->statut === 'en_attente')
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">⏳ En attente</span>
                                    @elseif ($demande->statut === 'acceptee')
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✅ Acceptée</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">❌ Refusée</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.demandes-suppression.show', $demande) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        Voir détails →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Aucune demande dans cette catégorie.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $demandes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
