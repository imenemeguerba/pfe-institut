<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commande extends Model
{
    /** @use HasFactory<\Database\Factories\CommandeFactory> */
    use HasFactory;

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'numero',
        'client_id',
        'statut',
        'prix_original',
        'prix_final',
        'code_promo_id',
        'date_confirmation',
        'date_annulation',
        'motif_annulation',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'prix_original' => 'integer',
        'prix_final' => 'integer',
        'date_confirmation' => 'datetime',
        'date_annulation' => 'datetime',
    ];

    /**
     * Mapping statut → label français.
     */
    public const STATUTS = [
        'en_attente' => 'En attente',
        'confirmee' => 'Confirmée',
        'annulee' => 'Annulée',
    ];

    // =========================================================================
    // RELATIONS
    // =========================================================================

    /**
     * Le client qui a passé la commande.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Le code promo utilisé (si applicable).
     */
    public function codePromo(): BelongsTo
    {
        return $this->belongsTo(CodePromo::class, 'code_promo_id');
    }

    /**
     * Les produits commandés (avec snapshot prix + quantité).
     */
    public function produits(): BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
            ->withPivot('quantite', 'prix_au_moment')
            ->withTimestamps();
    }

    /**
     * La facture associée (1:1, après confirmation).
     */
    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class);
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope : commandes en attente.
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    /**
     * Scope : commandes confirmées.
     */
    public function scopeConfirmees($query)
    {
        return $query->where('statut', 'confirmee');
    }

    /**
     * Scope : commandes pour un client.
     */
    public function scopePourClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
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
     * Calcule la réduction appliquée.
     */
    public function reductionAppliquee(): int
    {
        return $this->prix_original - $this->prix_final;
    }

    /**
     * Compte le nombre total d'articles.
     */
    public function nombreArticles(): int
    {
        return $this->produits->sum('pivot.quantite');
    }

    /**
     * Vérifie si la commande peut être annulée.
     */
    public function peutEtreAnnulee(): bool
    {
        return $this->statut === 'en_attente';
    }
}
