<?php

namespace App\Services;

use App\Models\RendezVous;
use App\Models\User;
use App\Models\Service;
use App\Models\CodePromo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RendezVousService
{
    /**
     * Vérifie la disponibilité d'un créneau
     */
    public function verifierDisponibilite(User $estheticienne, Carbon $dateDebut, int $dureeMinutes): array
    {
        $dateFin = $dateDebut->copy()->addMinutes($dureeMinutes);

        // Vérifier indisponibilités
        $indisponible = $estheticienne->indisponibilites()
            ->where('date_debut', '<=', $dateFin)
            ->where('date_fin', '>=', $dateDebut)
            ->exists();

        if ($indisponible) {
            return ['success' => false, 'message' => 'L\'esthéticienne est indisponible sur ce créneau.'];
        }

        // Vérifier chevauchement avec RDV existants
        $conflit = RendezVous::where('estheticienne_id', $estheticienne->id)
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->chevauchent($dateDebut, $dateFin)
            ->exists();

        if ($conflit) {
            return ['success' => false, 'message' => 'Ce créneau est déjà réservé.'];
        }

        return ['success' => true];
    }

    /**
     * Calculer prix et durée totale
     */
    public function calculerPrixTotal(array $serviceIds, ?CodePromo $codePromo = null): array
    {
        $services = Service::whereIn('id', $serviceIds)->get();

        $prixOriginal = $services->sum('prix');
        $dureeTotale = $services->sum('duree');
        $prixFinal = $prixOriginal;

        if ($codePromo && $codePromo->estValide()) {
            if ($codePromo->type_reduction === 'pourcentage') {
                $reduction = $prixOriginal * ($codePromo->valeur / 100);
            } else {
                $reduction = $codePromo->valeur;
            }
            $prixFinal = max(0, $prixOriginal - $reduction);
        }

        return [
            'prix_original' => $prixOriginal,
            'prix_final'    => $prixFinal,
            'duree_totale'  => $dureeTotale,
        ];
    }
}
