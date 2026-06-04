<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RendezVous extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rendez_vous';

    protected $fillable = [
        'groupe_reservation',
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
        'motif_report',
        'rappel_envoye_at',
    ];

    protected $casts = [
        'date_debut'     => 'datetime',
        'date_fin'       => 'datetime',
        'duree_totale'   => 'integer',
        'prix_original'  => 'integer',
        'prix_final'     => 'integer',
        'deleted_at'     => 'datetime',
    ];

    public const STATUTS = [
        'en_attente' => 'En attente',
        'confirme'   => 'Confirmé',
        'refuse'     => 'Refusé',
        'annule'     => 'Annulé',
        'termine'    => 'Terminé',
        'reporte'    => 'Reporté',
    ];

    // ====================== RELATIONS ======================
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function estheticienne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estheticienne_id');
    }

    public function codePromo(): BelongsTo
    {
        return $this->belongsTo(CodePromo::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'rendez_vous_service')
                    ->withPivot('prix_au_moment', 'duree_au_moment')
                    ->withTimestamps();
    }

    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class);
    }

    // ====================== SCOPES ======================
    public function scopeStatut($query, string $statut)
    {
        return $query->where('statut', $statut);
    }

    public function scopeAvenir($query)
    {
        return $query->where('date_debut', '>=', now());
    }

    public function scopePasses($query)
    {
        return $query->where('date_debut', '<', now());
    }

    public function scopeConfirmes($query)
    {
        return $query->where('statut', 'confirme');
    }

    public function scopePourEsthe($query, $estheId)
    {
        return $query->where('estheticienne_id', $estheId);
    }

    public function scopePourClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }

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

    // ====================== MÉTHODES ======================
    public function libelleStatut(): string
    {
        return self::STATUTS[$this->statut] ?? 'Inconnu';
    }

    public function peutEtreAnnule(): bool
    {
        return in_array($this->statut, ['en_attente', 'confirme'])
            && $this->date_debut->isFuture();
    }

    public function estPasse(): bool
    {
        return $this->date_debut->isPast();
    }

    public function reductionAppliquee(): int
    {
        return $this->prix_original - $this->prix_final;
    }
}
