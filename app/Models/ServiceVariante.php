<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceVariante extends Model
{
    protected $table = 'service_variantes';

    protected $fillable = ['service_id', 'nom', 'prix'];

    protected $casts = ['prix' => 'integer'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
