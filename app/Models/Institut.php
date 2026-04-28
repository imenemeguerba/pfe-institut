<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institut extends Model
{
    /** @use HasFactory<\Database\Factories\InstitutFactory> */
    use HasFactory;

    /**
     * Nom explicite (Laravel chercherait "instituts" sinon, mais y en a qu'un).
     */
    protected $table = 'institut';

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'nom',
        'description',
        'email',
        'telephone',
        'adresse',
        'ville',
        'code_postal',
        'logo',
        'facebook',
        'instagram',
        'whatsapp',
        'horaires_ouverture',
        'taux_tva',
        'seuil_affluence_eleve',
        'seuil_affluence_moyen',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'horaires_ouverture' => 'array',
        'taux_tva' => 'decimal:2',
        'seuil_affluence_eleve' => 'integer',
        'seuil_affluence_moyen' => 'integer',
    ];

    // =========================================================================
    // MÉTHODES MÉTIER (Singleton pattern)
    // =========================================================================

    /**
     * Retourne l'instance unique de l'institut.
     * Si aucune n'existe, en crée une avec valeurs par défaut.
     */
    public static function instance(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'nom' => 'Institut de Beauté',
                'email' => 'contact@institut-beaute.dz',
                'telephone' => '0555000000',
                'adresse' => 'Adresse à configurer',
                'taux_tva' => 19.00,
                'seuil_affluence_eleve' => 10,
                'seuil_affluence_moyen' => 5,
            ]
        );
    }

    /**
     * Calcule le niveau d'affluence pour une date donnée.
     * Retourne : 'faible' | 'moyen' | 'eleve'
     */
    public function calculerAffluence(?\DateTime $date = null): string
    {
        $date = $date ?? now();

        // Compter les RDV confirmés ce jour-là
        $nombreRdv = RendezVous::confirmes()
            ->whereDate('date_debut', $date->format('Y-m-d'))
            ->count();

        if ($nombreRdv >= $this->seuil_affluence_eleve) {
            return 'eleve';
        }

        if ($nombreRdv >= $this->seuil_affluence_moyen) {
            return 'moyen';
        }

        return 'faible';
    }

    /**
     * Retourne la couleur associée à l'affluence.
     */
    public function couleurAffluence(string $niveau): string
    {
        return match($niveau) {
            'faible' => 'vert',
            'moyen' => 'orange',
            'eleve' => 'rouge',
            default => 'gris',
        };
    }

    /**
     * Vérifie si l'institut est ouvert un jour donné selon les horaires.
     */
    public function estOuvert(string $jour): bool
    {
        if (!$this->horaires_ouverture) {
            return true; // Si pas configuré, on assume ouvert
        }

        $jour = strtolower($jour);

        return $this->horaires_ouverture[$jour]['ouvert'] ?? false;
    }
}
