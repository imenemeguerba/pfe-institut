<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'category_id',
        'nom',
        'description',
        'image',
        'prix',
        'duree',
        'actif',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'prix' => 'integer',
        'duree' => 'integer',
        'actif' => 'boolean',
    ];

    /**
     * Relation : un service appartient à une catégorie.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation : un service est maîtrisé par plusieurs esthéticiennes (N:N).
     */
    public function estheticiennes(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'service_estheticienne',
            'service_id',
            'estheticienne_id'
        );
    }

    /**
     * Scope : récupérer uniquement les services actifs.
     */
    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope : filtrer par catégorie.
     */
    public function scopeParCategorie($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope : filtrer par tranche de prix.
     */
    public function scopePrixEntre($query, $min, $max)
    {
        return $query->whereBetween('prix', [$min, $max]);
    }
    /**
     * Relation : un service peut être dans plusieurs RDV (N:N via pivot).
     */
    public function rendezVous(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            RendezVous::class,
            'rendez_vous_service',
            'service_id',
            'rendez_vous_id'
        )->withPivot('prix_au_moment', 'duree_au_moment')
         ->withTimestamps();
    }
    /**
     * Retourne la durée formatée joliment (ex: "1h30", "45min", "2h").
     */
    public function dureeFormatee(): string
    {
        $heures = intdiv($this->duree, 60);
        $minutes = $this->duree % 60;
        
        if ($heures === 0) {
            return $minutes . 'min';
        }
        
        if ($minutes === 0) {
            return $heures . 'h';
        }
        
        // Format "1h30" avec minutes sur 2 chiffres
        return $heures . 'h' . str_pad($minutes, 2, '0', STR_PAD_LEFT);
    }
}
