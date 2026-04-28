<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avis extends Model
{
    /** @use HasFactory<\Database\Factories\AvisFactory> */
    use HasFactory;

    /**
     * Nom explicite (Laravel pluriel "avises" est faux).
     */
    protected $table = 'avis';

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'client_id',
        'type',
        'estheticienne_id',
        'rendez_vous_id',
        'note',
        'commentaire',
        'statut',
        'motif_refus',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'note' => 'integer',
    ];

    /**
     * Mapping statut → label français.
     */
    public const STATUTS = [
        'en_attente' => 'En attente',
        'publie' => 'Publié',
        'refuse' => 'Refusé',
    ];

    // =========================================================================
    // RELATIONS
    // =========================================================================

    /**
     * Le client qui a écrit l'avis.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * L'esthéticienne concernée (si type=estheticienne, sinon null).
     */
    public function estheticienne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estheticienne_id');
    }

    /**
     * Le RDV concerné (si type=estheticienne).
     */
    public function rendezVous(): BelongsTo
    {
        return $this->belongsTo(RendezVous::class, 'rendez_vous_id');
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope : avis publiés (visibles publiquement).
     */
    public function scopePublies($query)
    {
        return $query->where('statut', 'publie');
    }

    /**
     * Scope : avis en attente de modération.
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    /**
     * Scope : avis sur les esthéticiennes.
     */
    public function scopeSurEsthe($query)
    {
        return $query->where('type', 'estheticienne');
    }

    /**
     * Scope : avis sur l'institut.
     */
    public function scopeSurInstitut($query)
    {
        return $query->where('type', 'institut');
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
     * Vérifie si l'avis est sur une esthéticienne.
     */
    public function estSurEsthe(): bool
    {
        return $this->type === 'estheticienne';
    }

    /**
     * Vérifie si l'avis est sur l'institut.
     */
    public function estSurInstitut(): bool
    {
        return $this->type === 'institut';
    }
}
