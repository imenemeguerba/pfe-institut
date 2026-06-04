<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'categorie_id',
        'description',
        'image',
        'prix',
        'stock',
        'seuil_alerte',
        'actif',
        'types_peau',
    ];

    protected $casts = [
        'prix'         => 'integer',
        'stock'        => 'integer',
        'seuil_alerte' => 'integer',
        'actif'        => 'boolean',
        'types_peau'  => 'array',
    ];

    // ── Relations ─────────────────────────────────────────────────────────

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(CategorieProduit::class, 'categorie_id');
    }

    public function paniers(): BelongsToMany
    {
        return $this->belongsToMany(Panier::class, 'panier_produit')
            ->withPivot('quantite')
            ->withTimestamps();
    }

    public function commandes(): BelongsToMany
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
            ->withPivot('quantite', 'prix_au_moment')
            ->withTimestamps();
    }

    public function clientsFavoris(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favoris', 'produit_id', 'client_id')
            ->withTimestamps();
    }

    // ── Scopes ────────────────────────────────────────────────────────────

    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    public function scopeEnStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeStockCritique($query)
    {
        return $query->whereColumn('stock', '<=', 'seuil_alerte');
    }

    // ── Méthodes ──────────────────────────────────────────────────────────

    public function isStockCritique(): bool
    {
        return $this->stock <= $this->seuil_alerte;
    }

    public function isRupture(): bool
    {
        return $this->stock <= 0;
    }
    public function variantes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProduitVariante::class);
    }
}
