<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CodePromo extends Model
{
    /** @use HasFactory<\Database\Factories\CodePromoFactory> */
    use HasFactory;

    /**
     * Nom explicite (sinon Laravel cherche "code_promos").
     */
    protected $table = 'codes_promo';

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'code',
        'description',
        'type_reduction',
        'valeur',
        'applicable_a',
        'date_debut',
        'date_fin',
        'limite_utilisation',
        'nombre_utilisations',
        'actif',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'valeur' => 'integer',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'limite_utilisation' => 'integer',
        'nombre_utilisations' => 'integer',
        'actif' => 'boolean',
    ];

    // =========================================================================
    // RELATIONS
    // =========================================================================

    /**
     * Les RDV qui ont utilisé ce code.
     */
    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class, 'code_promo_id');
    }

    /**
     * Les commandes qui ont utilisé ce code.
     */
    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class, 'code_promo_id');
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope : codes actifs et valides aujourd'hui.
     */
    public function scopeValides($query)
    {
        $now = now();
        return $query->where('actif', true)
            ->where('date_debut', '<=', $now)
            ->where('date_fin', '>=', $now);
    }

    // =========================================================================
    // MÉTHODES MÉTIER
    // =========================================================================

    /**
     * Vérifie si le code est encore utilisable.
     */
    public function estUtilisable(): bool
    {
        // Pas actif → non
        if (!$this->actif) {
            return false;
        }

        // Hors période → non
        $now = now();
        if ($this->date_debut->isFuture() || $this->date_fin->isPast()) {
            return false;
        }

        // Limite atteinte → non
        if ($this->limite_utilisation !== null
            && $this->nombre_utilisations >= $this->limite_utilisation) {
            return false;
        }

        return true;
    }

    /**
     * Calcule le montant de réduction pour un prix donné.
     */
    public function calculerReduction(int $prixOriginal): int
    {
        if ($this->type_reduction === 'pourcentage') {
            return (int) round($prixOriginal * $this->valeur / 100);
        }

        // Type "montant" : la réduction ne peut pas dépasser le prix
        return min($this->valeur, $prixOriginal);
    }

    /**
     * Applique la réduction sur un prix et retourne le prix final.
     */
    public function appliquerSur(int $prixOriginal): int
    {
        $reduction = $this->calculerReduction($prixOriginal);
        return max(0, $prixOriginal - $reduction);
    }
}
