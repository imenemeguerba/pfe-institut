<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon espace') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Message de bienvenue + Affluence --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Bienvenue, {{ Auth::user()->fullName() }} 💖</h3>

                    {{-- Indicateur d'affluence --}}
                    <div class="mt-4 flex items-center gap-3">
                        <span class="text-sm text-gray-600">Affluence aujourd'hui :</span>
                        @php
                            $couleurs = [
                                'vert' => 'bg-green-500',
                                'orange' => 'bg-orange-500',
                                'rouge' => 'bg-red-500',
                            ];
                            $labels = [
                                'faible' => 'Faible',
                                'moyen' => 'Moyen',
                                'eleve' => 'Élevé',
                            ];
                        @endphp
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-white text-sm font-medium {{ $couleurs[$data['couleur_affluence']] ?? 'bg-gray-500' }}">
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            {{ $labels[$data['affluence_aujourdhui']] ?? 'Inconnu' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Mes prochains RDV --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">📅 Mes prochains rendez-vous</h4>

                    @if ($data['rdv_a_venir']->isEmpty())
                        <p class="text-gray-500 text-sm">Vous n'avez aucun rendez-vous à venir.</p>
                    @else
                        <ul class="space-y-3">
                            @foreach ($data['rdv_a_venir'] as $rdv)
                                <li class="border-l-4 border-pink-500 pl-3">
                                    <div class="font-medium">{{ $rdv->date_debut->format('d/m/Y à H:i') }}</div>
                                    <div class="text-sm text-gray-600">avec {{ $rdv->estheticienne->fullName() }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Mes commandes récentes --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">🛒 Mes commandes récentes</h4>

                    @if ($data['commandes_recentes']->isEmpty())
                        <p class="text-gray-500 text-sm">Vous n'avez passé aucune commande.</p>
                    @else
                        <ul class="space-y-3">
                            @foreach ($data['commandes_recentes'] as $commande)
                                <li class="border-l-4 border-pink-500 pl-3">
                                    <div class="font-medium">{{ $commande->numero }}</div>
                                    <div class="text-sm text-gray-600">{{ $commande->prix_final }} DA — {{ $commande->libelleStatut() }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
