<?php
// ════════════════════════════════════════════════════════
// app/Services/FideliteService.php
// ════════════════════════════════════════════════════════

namespace App\Services;

use App\Models\FidelitePoint;
use App\Models\User;

class FideliteService
{
    // Points gagnés
    const POINTS_PAR_RDV      = 10;
    const POINTS_PAR_COMMANDE = 5;

    // Niveaux
    const NIVEAUX = [
        'bronze' => ['min' => 0,   'max' => 99,  'label' => 'Bronze', 'icon' => '🥉', 'reduction' => 0],
        'silver' => ['min' => 100, 'max' => 299, 'label' => 'Silver', 'icon' => '🥈', 'reduction' => 5],
        'gold'   => ['min' => 300, 'max' => null,'label' => 'Gold',   'icon' => '🥇', 'reduction' => 10],
    ];

    /**
     * Calcule le total de points d'un client
     */
    public static function totalPoints(User $client): int
    {
        return (int) FidelitePoint::where('client_id', $client->id)->sum('points');
    }

    /**
     * Retourne le niveau du client selon ses points
     */
    public static function niveau(int $points): array
    {
        if ($points >= 300) return self::NIVEAUX['gold'];
        if ($points >= 100) return self::NIVEAUX['silver'];
        return self::NIVEAUX['bronze'];
    }

    /**
     * Points nécessaires pour le prochain niveau
     */
    public static function pointsPourNiveauSuivant(int $points): ?int
    {
        if ($points < 100) return 100 - $points;
        if ($points < 300) return 300 - $points;
        return null; // déjà Gold
    }

    /**
     * Ajouter des points pour un RDV terminé
     */
    public static function ajouterPourRdv(User $client, $rendezVous): void
    {
        // Vérifier si déjà crédité pour ce RDV
        $existe = FidelitePoint::where('client_id', $client->id)
            ->where('source_type', 'App\Models\RendezVous')
            ->where('source_id', $rendezVous->id)
            ->exists();

        if ($existe) return;

        FidelitePoint::create([
            'client_id'   => $client->id,
            'points'      => self::POINTS_PAR_RDV,
            'type'        => 'rdv',
            'description' => '+' . self::POINTS_PAR_RDV . ' points — Rendez-vous du ' . $rendezVous->date_debut->format('d/m/Y'),
            'source_type' => 'App\Models\RendezVous',
            'source_id'   => $rendezVous->id,
        ]);
    }

    /**
     * Ajouter des points pour une commande confirmée
     */
    public static function ajouterPourCommande(User $client, $commande): void
    {
        $existe = FidelitePoint::where('client_id', $client->id)
            ->where('source_type', 'App\Models\Commande')
            ->where('source_id', $commande->id)
            ->exists();

        if ($existe) return;

        FidelitePoint::create([
            'client_id'   => $client->id,
            'points'      => self::POINTS_PAR_COMMANDE,
            'type'        => 'commande',
            'description' => '+' . self::POINTS_PAR_COMMANDE . ' points — Commande ' . $commande->numero,
            'source_type' => 'App\Models\Commande',
            'source_id'   => $commande->id,
        ]);
    }

    /**
     * Calculer la réduction applicable pour un client
     */
    public static function reductionPourcent(User $client): int
    {
        $points = self::totalPoints($client);
        $niveau = self::niveau($points);
        return $niveau['reduction'];
    }

    /**
     * Toutes les infos fidélité d'un client
     */
    public static function infos(User $client): array
    {
        $points          = self::totalPoints($client);
        $niveau          = self::niveau($points);
        $pointsSuivant   = self::pointsPourNiveauSuivant($points);
        $historique      = FidelitePoint::where('client_id', $client->id)
                            ->orderByDesc('created_at')
                            ->get();

        return compact('points', 'niveau', 'pointsSuivant', 'historique');
    }
}
