<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord — Esthéticienne') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Message de bienvenue --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Bonjour, {{ Auth::user()->fullName() }} 💄</h3>
                    <p class="text-gray-600">Voici votre activité du jour.</p>
                </div>
            </div>

            {{-- Grille des statistiques --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- RDV aujourd'hui --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500">📅 RDV aujourd'hui</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['rdv_aujourdhui'] }}</div>
                </div>

                {{-- RDV à traiter --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 {{ $stats['rdv_a_traiter'] > 0 ? 'border-l-4 border-orange-500' : '' }}">
                    <div class="text-sm font-medium text-gray-500">⏳ Demandes à traiter</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['rdv_a_traiter'] }}</div>
                </div>

                {{-- RDV terminés ce mois --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500">✅ Terminés ce mois</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['rdv_du_mois'] }}</div>
                </div>

                {{-- Avis reçus --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500">⭐ Avis publiés</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['avis_recus'] }}</div>
                </div>

                {{-- Note moyenne --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 md:col-span-2">
                    <div class="text-sm font-medium text-gray-500">🌟 Note moyenne</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">
                        {{ number_format($stats['note_moyenne'], 1) }} / 5
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
