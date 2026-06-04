<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategorieProduit extends Model
{
    protected $table = 'categories_produits';

    protected $fillable = ['nom', 'description', 'actif'];

    protected $casts = ['actif' => 'boolean'];

    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class, 'categorie_id');
    }
}
