<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produit extends Model
{
    /** @use HasFactory<\Database\Factories\ProduitFactory> */
    use HasFactory;

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
        'nom',
        'description',
        'image',
        'prix',
        'stock',
        'seuil_alerte',
        'actif',
    ];

    /**
     * Conversion automatique des types.
     */
    protected $casts = [
        'prix' => 'integer',
        'stock' => 'integer',
        'seuil_alerte' => 'integer',
        'actif' => 'boolean',
    ];

    /**
     * Relation : un produit peut être dans plusieurs paniers (N:N avec quantité).
     */
    public function paniers(): BelongsToMany
    {
        return $this->belongsToMany(Panier::class, 'panier_produit')
            ->withPivot('quantite')
            ->withTimestamps();
    }

    /**
     * Relation : un produit peut être dans plusieurs commandes (N:N avec snapshot).
     */
    public function commandes(): BelongsToMany
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
            ->withPivot('quantite', 'prix_au_moment')
            ->withTimestamps();
    }

    /**
     * Relation : un produit peut être en favori chez plusieurs clients (N:N).
     */
    public function clientsFavoris(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'favoris',
            'produit_id',
            'client_id'
        )->withTimestamps();
    }

    /**
     * Scope : produits actifs.
     */
    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope : produits en stock (stock > 0).
     */
    public function scopeEnStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Scope : produits avec stock critique (alerte admin).
     */
    public function scopeStockCritique($query)
    {
        return $query->whereColumn('stock', '<=', 'seuil_alerte');
    }

    /**
     * Vérifie si le stock est critique (<=  seuil_alerte).
     */
    public function isStockCritique(): bool
    {
        return $this->stock <= $this->seuil_alerte;
    }

    /**
     * Vérifie si le produit est en rupture de stock.
     */
    public function isRupture(): bool
    {
        return $this->stock <= 0;
    }
}
