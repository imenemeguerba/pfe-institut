<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Panier extends Model
{
    /** @use HasFactory<\Database\Factories\PanierFactory> */
    use HasFactory;

    /**
     * Nom explicite de la table (sinon Laravel cherche "paniers" ce qui marche, mais explicite c'est mieux).
     */
    protected $table = 'paniers';

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'client_id',
    ];

    /**
     * Le client propriétaire du panier.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Les produits dans le panier (avec quantité).
     */
    public function produits(): BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'panier_produit')
            ->withPivot('quantite')
            ->withTimestamps();
    }

    /**
     * Calcule le total actuel du panier (basé sur les prix actuels des produits).
     */
    public function total(): int
    {
        return $this->produits->sum(function ($produit) {
            return $produit->prix * $produit->pivot->quantite;
        });
    }

    /**
     * Compte le nombre total d'articles (somme des quantités).
     */
    public function nombreArticles(): int
    {
        return $this->produits->sum('pivot.quantite');
    }

    /**
     * Vérifie si le panier est vide.
     */
    public function estVide(): bool
    {
        return $this->produits->isEmpty();
    }

    /**
     * Vide le panier (supprime tous les produits).
     */
    public function vider(): void
    {
        $this->produits()->detach();
    }
}
