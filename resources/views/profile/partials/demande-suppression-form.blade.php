<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Supprimer mon compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            La suppression de votre compte n'est pas immédiate. Votre demande sera examinée par notre administrateur, qui vérifiera notamment l'absence de rendez-vous à venir avant de l'approuver.
        </p>
    </header>

    @php
        $demandeEnCours = Auth::user()->demandeSuppressionEnCours();
    @endphp

    @if ($demandeEnCours)
        {{-- Demande en cours --}}
        <div class="bg-orange-50 border-l-4 border-orange-400 p-4 rounded">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-orange-800">⏳ Demande de suppression en attente</p>
                    <p class="mt-1 text-xs text-gray-600">Soumise le {{ $demandeEnCours->created_at->format('d/m/Y à H:i') }}</p>
                    @if ($demandeEnCours->motif_demande)
                        <p class="mt-2 text-sm text-gray-700"><strong>Votre motif :</strong> {{ $demandeEnCours->motif_demande }}</p>
                    @endif
                </div>

                <form method="POST" action="{{ route('demande-suppression.annuler', $demandeEnCours) }}"
                      onsubmit="return confirm('Annuler votre demande de suppression ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 underline">
                        Annuler ma demande
                    </button>
                </form>
            </div>
        </div>
    @else
        {{-- Formulaire de demande --}}
        <form method="POST" action="{{ route('demande-suppression.store') }}">
            @csrf

            <div class="mb-4">
                <label for="motif_demande" class="block text-sm font-medium text-gray-700">
                    Motif de votre demande (optionnel)
                </label>
                <textarea id="motif_demande" name="motif_demande" rows="3" maxlength="500"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          placeholder="Pourquoi souhaitez-vous supprimer votre compte ?">{{ old('motif_demande') }}</textarea>
            </div>

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700"
                    onclick="return confirm('Soumettre une demande de suppression de votre compte ?');">
                {{ __('Demander la suppression de mon compte') }}
            </button>
        </form>
    @endif
</section>
