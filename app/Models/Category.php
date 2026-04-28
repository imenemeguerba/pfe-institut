<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'nom',
        'description',
        'image',
        'actif',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'actif' => 'boolean',
    ];

    /**
     * Relation : une catégorie a plusieurs services.
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Scope : récupérer uniquement les catégories actives.
     */
    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }
}
