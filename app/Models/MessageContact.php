<?php
// app/Models/MessageContact.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageContact extends Model
{
    protected $table = 'messages_contact';

    protected $fillable = [
        'user_id',
        'sujet',
        'message',
        'reponse_admin',
        'repondu_at',
        'lu',
    ];

    protected $casts = [
        'lu'         => 'boolean',
        'repondu_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function estRepondu(): bool
    {
        return !is_null($this->reponse_admin);
    }
}
