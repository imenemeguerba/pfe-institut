<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemandeSuppression extends Model
{
    /** @use HasFactory<\Database\Factories\DemandeSuppressionFactory> */
    use HasFactory;

    /**
     * Nom explicite (Laravel chercherait "demande_suppressions" sinon).
     */
    protected $table = 'demandes_suppression';

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'user_id',
        'statut',
        'motif_demande',
        'motif_refus',
        'date_traitement',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'date_traitement' => 'datetime',
    ];

    /**
     * Mapping statut → label français.
     */
    public const STATUTS = [
        'en_attente' => 'En attente',
        'acceptee' => 'Acceptée',
        'refusee' => 'Refusée',
    ];

    // =========================================================================
    // RELATIONS
    // =========================================================================

    /**
     * L'utilisateur qui demande la suppression.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope : demandes en attente.
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    /**
     * Scope : demandes acceptées.
     */
    public function scopeAcceptees($query)
    {
        return $query->where('statut', 'acceptee');
    }

    /**
     * Scope : demandes refusées.
     */
    public function scopeRefusees($query)
    {
        return $query->where('statut', 'refusee');
    }

    // =========================================================================
    // MÉTHODES MÉTIER
    // =========================================================================

    /**
     * Retourne le label du statut en français.
     */
    public function libelleStatut(): string
    {
        return self::STATUTS[$this->statut] ?? 'Inconnu';
    }

    /**
     * Vérifie si la demande est en attente.
     */
    public function estEnAttente(): bool
    {
        return $this->statut === 'en_attente';
    }

    /**
     * Vérifie si la demande a été traitée.
     */
    public function estTraitee(): bool
    {
        return in_array($this->statut, ['acceptee', 'refusee']);
    }
}
