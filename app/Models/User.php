<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'role',
        'telephone',
        'date_naissance',
        'experience',
        'bio',
        'photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_naissance' => 'date',
            'password' => 'hashed',
        ];
    }

    /**
     * Retourne le nom complet (prénom + nom).
     */
    public function fullName(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    /**
     * Vérifie si l'utilisateur est majeur (>= 18 ans).
     */
    public function isMajeur(): bool
    {
        if (!$this->date_naissance) {
            return false;
        }

        return $this->date_naissance->age >= 18;
    }

    /**
     * Vérifie si l'utilisateur est admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est esthéticienne.
     */
    public function isEstheticienne(): bool
    {
        return $this->role === 'estheticienne';
    }

    /**
     * Vérifie si l'utilisateur est client.
     */
    public function isClient(): bool
    {
        return $this->role === 'client';
    }
}
