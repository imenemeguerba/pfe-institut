<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favori extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriFactory> */
    use HasFactory;

    /**
     * Nom explicite (sinon Laravel cherche "favoris" qui marche, mais explicite est mieux).
     */
    protected $table = 'favoris';

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'client_id',
        'produit_id',
    ];

    /**
     * Le client qui a ajouté en favori.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Le produit favori.
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
