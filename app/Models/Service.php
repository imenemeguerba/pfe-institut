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
}
