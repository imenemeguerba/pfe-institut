<?php
 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationOtp extends Model
{
    protected $table = 'registration_otps';

    protected $fillable = ['email', 'otp', 'expires_at'];

    protected $casts = ['expires_at' => 'datetime'];

    public function estExpire(): bool
    {
        return $this->expires_at->isPast();
    }
}
