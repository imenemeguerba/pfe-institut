<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord — Administration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Message de bienvenue --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Bienvenue, {{ Auth::user()->fullName() }} 👋</h3>
                    <p class="text-gray-600">Voici une vue d'ensemble de votre institut aujourd'hui.</p>
                </div>
            </div>

            {{-- Grille des statistiques --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Total clients --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500">Total clients</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total_clients'] }}</div>
                </div>

                {{-- Esthéticiennes actives --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500">Esthéticiennes actives</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total_estheticiennes'] }}</div>
                </div>

                {{-- Esthéticiennes en attente --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 {{ $stats['esthe_en_attente'] > 0 ? 'border-l-4 border-orange-500' : '' }}">
                    <div class="text-sm font-medium text-gray-500">⏳ En attente de validation</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['esthe_en_attente'] }}</div>
                </div>

                {{-- RDV aujourd'hui --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500">📅 RDV aujourd'hui</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['rdv_aujourdhui'] }}</div>
                </div>

                {{-- Commandes à traiter --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 {{ $stats['commandes_a_traiter'] > 0 ? 'border-l-4 border-orange-500' : '' }}">
                    <div class="text-sm font-medium text-gray-500">🛒 Commandes à confirmer</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['commandes_a_traiter'] }}</div>
                </div>

                {{-- Avis à modérer --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 {{ $stats['avis_a_moderer'] > 0 ? 'border-l-4 border-orange-500' : '' }}">
                    <div class="text-sm font-medium text-gray-500">⭐ Avis à modérer</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['avis_a_moderer'] }}</div>
                </div>

                {{-- Demandes suppression --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 {{ $stats['demandes_suppression'] > 0 ? 'border-l-4 border-orange-500' : '' }}">
                    <div class="text-sm font-medium text-gray-500">🗑️ Demandes de suppression</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['demandes_suppression'] }}</div>
                </div>

                {{-- Stock critique --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 {{ $stats['produits_stock_critique'] > 0 ? 'border-l-4 border-red-500' : '' }}">
                    <div class="text-sm font-medium text-gray-500">⚠️ Stock critique</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['produits_stock_critique'] }}</div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
