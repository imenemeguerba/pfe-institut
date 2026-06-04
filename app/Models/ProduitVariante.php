<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProduitVariante extends Model
{
    protected $table = 'produit_variantes';

    protected $fillable = ['produit_id', 'nom', 'prix', 'stock'];

    protected $casts = [
        'prix'  => 'integer',
        'stock' => 'integer',
    ];

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
