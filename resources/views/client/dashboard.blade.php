<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mon espace</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Bienvenue, {{ Auth::user()->fullName() }} 💖</h3>
                    <div class="mt-4 flex items-center gap-3">
                        <span class="text-sm text-gray-600">Affluence aujourd'hui :</span>
                        @php
                            $couleurs = ['vert' => 'bg-green-500', 'orange' => 'bg-orange-500', 'rouge' => 'bg-red-500'];
                            $labels   = ['faible' => 'Faible', 'moyen' => 'Moyen', 'eleve' => 'Élevé'];
                        @endphp
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-white text-sm font-medium {{ $couleurs[$data['couleur_affluence']] ?? 'bg-gray-500' }}">
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            {{ $labels[$data['affluence_aujourdhui']] ?? 'Inconnu' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg mb-6 p-6">
                <h3 class="text-sm font-medium text-gray-500 mb-3">Navigation rapide</h3>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('client.reservation.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold hover:bg-indigo-700">📅 Prendre un RDV</a>
                    <a href="{{ route('client.services.index') }}" class="px-3 py-2 bg-indigo-50 text-indigo-700 rounded-md text-sm hover:bg-indigo-100">💄 Services</a>
                    <a href="{{ route('client.rendez-vous.index') }}" class="px-3 py-2 bg-indigo-50 text-indigo-700 rounded-md text-sm hover:bg-indigo-100">📋 Mes RDV</a>
                    <a href="{{ route('client.avis.index') }}" class="px-3 py-2 bg-yellow-50 text-yellow-700 rounded-md text-sm hover:bg-yellow-100">⭐ Mes avis</a>
                    <a href="{{ route('client.produits.index') }}" class="px-3 py-2 bg-pink-50 text-pink-700 rounded-md text-sm hover:bg-pink-100">🧴 Boutique</a>
                    <a href="{{ route('client.panier.index') }}" class="px-3 py-2 bg-pink-50 text-pink-700 rounded-md text-sm hover:bg-pink-100">🛒 Panier</a>
                    <a href="{{ route('client.favoris.index') }}" class="px-3 py-2 bg-red-50 text-red-700 rounded-md text-sm hover:bg-red-100">❤️ Favoris</a>
                    <a href="{{ route('client.commandes.index') }}" class="px-3 py-2 bg-orange-50 text-orange-700 rounded-md text-sm hover:bg-orange-100">📦 Commandes</a>
                    <a href="{{ route('client.factures.index') }}" class="px-3 py-2 bg-green-50 text-green-700 rounded-md text-sm hover:bg-green-100">🧾 Factures</a>
                    <a href="{{ route('client.recommandations.index') }}" class="px-3 py-2 bg-purple-50 text-purple-700 rounded-md text-sm hover:bg-purple-100">✨ Recommandations</a>
                    <a href="{{ route('client.fidelite.index') }}" class="px-3 py-2 bg-yellow-50 text-yellow-700 rounded-md text-sm hover:bg-yellow-100">🎁 Fidélité</a>
                    <a href="{{ route('client.contact.index') }}" class="px-3 py-2 bg-gray-50 text-gray-700 rounded-md text-sm hover:bg-gray-100">📩 Contact</a>
                    <a href="{{ route('client.questionnaire.index') }}" class="px-3 py-2 bg-rose-50 text-rose-700 rounded-md text-sm hover:bg-rose-100">🔬 Analyse peau</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold">📅 Prochains rendez-vous</h4>
                        <a href="{{ route('client.rendez-vous.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800">Voir tout →</a>
                    </div>
                    @if ($data['rdv_a_venir']->isEmpty())
                        <p class="text-gray-500 text-sm mb-3">Aucun rendez-vous à venir.</p>
                        <a href="{{ route('client.reservation.create') }}" class="text-sm text-indigo-600">Prendre un RDV →</a>
                    @else
                        <ul class="space-y-3">
                            @foreach ($data['rdv_a_venir'] as $rdv)
                                <li class="border-l-4 border-pink-500 pl-3">
                                    <p class="font-medium text-sm">{{ $rdv->date_debut->format('d/m/Y à H:i') }}</p>
                                    <p class="text-xs text-gray-600">avec {{ $rdv->estheticienne->fullName() }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold">🛒 Commandes récentes</h4>
                        <a href="{{ route('client.commandes.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800">Voir tout →</a>
                    </div>
                    @if ($data['commandes_recentes']->isEmpty())
                        <p class="text-gray-500 text-sm mb-3">Aucune commande.</p>
                        <a href="{{ route('client.produits.index') }}" class="text-sm text-pink-600">Voir la boutique →</a>
                    @else
                        <ul class="space-y-3">
                            @foreach ($data['commandes_recentes'] as $commande)
                                <li class="border-l-4 border-orange-400 pl-3">
                                    <p class="font-medium text-sm font-mono">{{ $commande->numero }}</p>
                                    <p class="text-xs text-gray-600">{{ number_format($commande->prix_final, 0, ',', ' ') }} DA</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
