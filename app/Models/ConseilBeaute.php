<?php
// app/Models/ConseilBeaute.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConseilBeaute extends Model
{
    protected $table = 'conseils_beaute';

    protected $fillable = [
        'titre',
        'contenu',
        'type_peau',
        'categorie',
        'emoji',
        'actif',
        'ordre',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer',
    ];

    // Scopes
    public function scopeActifs($query) {
        return $query->where('actif', true);
    }

    public function scopePourTypePeau($query, string $typePeau) {
        return $query->where(function($q) use ($typePeau) {
            $q->where('type_peau', $typePeau)
              ->orWhere('type_peau', 'tous');
        });
    }
}
