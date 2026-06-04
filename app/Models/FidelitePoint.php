<?php
// ════════════════════════════════════════════════════════
// app/Models/FidelitePoint.php
// ════════════════════════════════════════════════════════

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FidelitePoint extends Model
{
    protected $table = 'fidelite_points';

    protected $fillable = [
        'client_id',
        'points',
        'type',
        'description',
        'source_type',
        'source_id',
    ];

    protected $casts = [
        'points' => 'integer',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function source(): MorphTo
    {
        return $this->morphTo();
    }
}
