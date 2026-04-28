<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    /** @use HasFactory<\Database\Factories\FactureFactory> */
    use HasFactory;

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'numero',
        'client_id',
        'type',
        'rendez_vous_id',
        'commande_id',
        'montant_ht',
        'montant_tva',
        'montant_ttc',
        'taux_tva',
        'date_emission',
        'chemin_pdf',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'montant_ht' => 'integer',
        'montant_tva' => 'integer',
        'montant_ttc' => 'integer',
        'taux_tva' => 'decimal:2',
        'date_emission' => 'datetime',
    ];

    // =========================================================================
    // RELATIONS
    // =========================================================================

    /**
     * Le client de la facture.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Le RDV lié (si type=rendez_vous).
     */
    public function rendezVous(): BelongsTo
    {
        return $this->belongsTo(RendezVous::class, 'rendez_vous_id');
    }

    /**
     * La commande liée (si type=commande).
     */
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope : factures de RDV.
     */
    public function scopeDeRdv($query)
    {
        return $query->where('type', 'rendez_vous');
    }

    /**
     * Scope : factures de commandes.
     */
    public function scopeDeCommandes($query)
    {
        return $query->where('type', 'commande');
    }

    /**
     * Scope : factures d'un client.
     */
    public function scopePourClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

    // =========================================================================
    // MÉTHODES MÉTIER
    // =========================================================================

    /**
     * Vérifie si la facture concerne un RDV.
     */
    public function estDeRdv(): bool
    {
        return $this->type === 'rendez_vous';
    }

    /**
     * Vérifie si la facture concerne une commande.
     */
    public function estDeCommande(): bool
    {
        return $this->type === 'commande';
    }
}
