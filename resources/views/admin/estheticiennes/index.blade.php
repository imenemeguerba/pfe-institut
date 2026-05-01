<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des esthéticiennes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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

            {{-- Onglets de filtre --}}
            <div class="bg-white shadow-sm rounded-lg mb-6 overflow-hidden">
                <div class="flex border-b border-gray-200">
                    <a href="{{ route('admin.estheticiennes.index', ['filtre' => 'en_attente']) }}"
                       class="px-6 py-4 text-sm font-medium border-b-2 transition {{ $filtre === 'en_attente' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        ⏳ En attente
                        @if ($compteurs['en_attente'] > 0)
                            <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                {{ $compteurs['en_attente'] }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('admin.estheticiennes.index', ['filtre' => 'actives']) }}"
                       class="px-6 py-4 text-sm font-medium border-b-2 transition {{ $filtre === 'actives' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        ✅ Actives <span class="ml-1 text-xs text-gray-500">({{ $compteurs['actives'] }})</span>
                    </a>
                    <a href="{{ route('admin.estheticiennes.index', ['filtre' => 'desactives']) }}"
                       class="px-6 py-4 text-sm font-medium border-b-2 transition {{ $filtre === 'desactives' ? 'border-gray-500 text-gray-700' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        🚫 Désactivées <span class="ml-1 text-xs text-gray-500">({{ $compteurs['desactives'] }})</span>
                    </a>
                    <a href="{{ route('admin.estheticiennes.index', ['filtre' => 'toutes']) }}"
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom complet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Expérience</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Inscrite le</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($estheticiennes as $esthe)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $esthe->fullName() }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $esthe->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $esthe->telephone }}</td>
                                <td class="px-6 py-4 text-center text-sm text-gray-600">{{ $esthe->experience }} an(s)</td>
                                <td class="px-6 py-4 text-center">
                                    @if ($esthe->statut_compte === 'en_attente_validation')
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">⏳ En attente</span>
                                    @elseif ($esthe->statut_compte === 'actif')
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✅ Active</span>
                                    @elseif ($esthe->statut_compte === 'desactive')
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">🚫 Désactivée</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">⛔ Bloquée</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $esthe->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.estheticiennes.show', $esthe) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        Voir détails →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Aucune esthéticienne dans cette catégorie.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $estheticiennes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
