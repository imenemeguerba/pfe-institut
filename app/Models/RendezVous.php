<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RendezVous extends Model
{
    /** @use HasFactory<\Database\Factories\RendezVousFactory> */
    use HasFactory;

    /**
     * Nom explicite de la table (sinon Laravel cherche "rendez_vouses").
     */
    protected $table = 'rendez_vous';

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'client_id',
        'estheticienne_id',
        'date_debut',
        'date_fin',
        'duree_totale',
        'prix_original',
        'prix_final',
        'code_promo_id',
        'statut',
        'notes',
        'motif_refus',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'duree_totale' => 'integer',
        'prix_original' => 'integer',
        'prix_final' => 'integer',
    ];

    /**
     * Mapping statut → label français.
     */
    public const STATUTS = [
        'en_attente' => 'En attente',
        'confirme' => 'Confirmé',
        'refuse' => 'Refusé',
        'annule' => 'Annulé',
        'termine' => 'Terminé',
    ];

    // =========================================================================
    // RELATIONS
    // =========================================================================

    /**
     * Le client qui a réservé.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * L'esthéticienne assignée.
     */
    public function estheticienne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estheticienne_id');
    }

    /**
     * Le code promo utilisé (si applicable).
     */
    public function codePromo(): BelongsTo
    {
        return $this->belongsTo(CodePromo::class, 'code_promo_id');
    }

    /**
     * Les services réservés dans ce RDV (N:N avec snapshot prix/durée).
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'rendez_vous_service')
            ->withPivot('prix_au_moment', 'duree_au_moment')
            ->withTimestamps();
    }

    /**
     * La facture associée (1:1, après réalisation).
     */
    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class);
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope : RDV par statut.
     */
    public function scopeStatut($query, string $statut)
    {
        return $query->where('statut', $statut);
    }

    /**
     * Scope : RDV à venir (date_debut dans le futur).
     */
    public function scopeAvenir($query)
    {
        return $query->where('date_debut', '>=', now());
    }

    /**
     * Scope : RDV passés (date_debut dans le passé).
     */
    public function scopePasses($query)
    {
        return $query->where('date_debut', '<', now());
    }

    /**
     * Scope : RDV confirmés.
     */
    public function scopeConfirmes($query)
    {
        return $query->where('statut', 'confirme');
    }

    /**
     * Scope : RDV pour une esthéticienne.
     */
    public function scopePourEsthe($query, $estheId)
    {
        return $query->where('estheticienne_id', $estheId);
    }

    /**
     * Scope : RDV pour un client.
     */
    public function scopePourClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    /**
     * Scope : RDV qui chevauchent une période donnée.
     */
    public function scopeChevauchent($query, $debut, $fin)
    {
        return $query->where(function ($q) use ($debut, $fin) {
            $q->whereBetween('date_debut', [$debut, $fin])
              ->orWhereBetween('date_fin', [$debut, $fin])
              ->orWhere(function ($q2) use ($debut, $fin) {
                  $q2->where('date_debut', '<=', $debut)
                     ->where('date_fin', '>=', $fin);
              });
        });
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
     * Vérifie si le RDV peut encore être annulé par le client.
     */
    public function peutEtreAnnule(): bool
    {
        return in_array($this->statut, ['en_attente', 'confirme'])
            && $this->date_debut->isFuture();
    }

    /**
     * Vérifie si le RDV est passé.
     */
    public function estPasse(): bool
    {
        return $this->date_debut->isPast();
    }

    /**
     * Calcule la réduction appliquée (en DA).
     */
    public function reductionAppliquee(): int
    {
        return $this->prix_original - $this->prix_final;
    }
}
