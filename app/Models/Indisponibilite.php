<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Indisponibilite extends Model
{
    /** @use HasFactory<\Database\Factories\IndisponibiliteFactory> */
    use HasFactory;

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'estheticienne_id',
        'date_debut',
        'date_fin',
        'type',
        'motif',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    /**
     * Mapping type → label français.
     */
    public const TYPES = [
        'conge' => 'Congé',
        'ferie' => 'Jour férié',
        'maladie' => 'Maladie',
        'formation' => 'Formation',
        'autre' => 'Autre',
    ];

    /**
     * Relation : une indisponibilité appartient à une esthéticienne.
     */
    public function estheticienne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estheticienne_id');
    }

    /**
     * Scope : indisponibilités à venir (date_debut dans le futur).
     */
    public function scopeAvenir($query)
    {
        return $query->where('date_debut', '>=', now());
    }

    /**
     * Scope : indisponibilités qui chevauchent une période donnée.
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

    /**
     * Retourne le label du type en français.
     */
    public function libelleType(): string
    {
        return self::TYPES[$this->type] ?? 'Autre';
    }
}
