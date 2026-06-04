<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvantApres extends Model
{
    protected $table = 'avant_apres';

    protected $fillable = [
        'estheticienne_id',
        'titre',
        'service',
        'photo_avant',
        'photo_apres',
        'description',
        'public',
    ];

    protected $casts = [
        'public' => 'boolean',
    ];

    public function estheticienne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estheticienne_id');
    }
}
