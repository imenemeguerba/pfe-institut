<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disponibilite extends Model
{
    /** @use HasFactory<\Database\Factories\DisponibiliteFactory> */
    use HasFactory;

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'estheticienne_id',
        'jour_semaine',
        'heure_debut',
        'heure_fin',
        'actif',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'jour_semaine' => 'integer',
        'actif' => 'boolean',
    ];

    /**
     * Mapping jour_semaine → nom français.
     */
    public const JOURS = [
        1 => 'Lundi',
        2 => 'Mardi',
        3 => 'Mercredi',
        4 => 'Jeudi',
        5 => 'Vendredi',
        6 => 'Samedi',
        7 => 'Dimanche',
    ];

    /**
     * Relation : une disponibilité appartient à une esthéticienne.
     */
    public function estheticienne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estheticienne_id');
    }

    /**
     * Scope : disponibilités actives.
     */
    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope : pour un jour spécifique de la semaine (1-7).
     */
    public function scopePourJour($query, int $jour)
    {
        return $query->where('jour_semaine', $jour);
    }

    /**
     * Retourne le nom du jour en français.
     */
    public function nomJour(): string
    {
        return self::JOURS[$this->jour_semaine] ?? 'Inconnu';
    }
}
