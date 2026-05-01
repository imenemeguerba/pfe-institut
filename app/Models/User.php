<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'role',
        'statut_compte',
        'motif_statut',
        'email_libre_le',
        'telephone',
        'date_naissance',
        'experience',
        'specialites',
        'bio',
        'photo',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_naissance' => 'date',
            'experience' => 'integer',
            'email_libre_le' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================================================================
    // RELATIONS — pour TOUS les utilisateurs
    // =========================================================================

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'client_id');
    }

    public function factures(): HasMany
    {
        return $this->hasMany(Facture::class, 'client_id');
    }

    public function demandesSuppression(): HasMany
    {
        return $this->hasMany(DemandeSuppression::class);
    }

    public function demandeSuppressionEnCours(): ?DemandeSuppression
    {
        return $this->demandesSuppression()
            ->where('statut', 'en_attente')
            ->first();
    }

    // =========================================================================
    // RELATIONS — CLIENTS
    // =========================================================================

    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class, 'client_id');
    }

    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class, 'client_id');
    }

    public function panier(): HasOne
    {
        return $this->hasOne(Panier::class, 'client_id');
    }

    public function produitsFavoris(): BelongsToMany
    {
        return $this->belongsToMany(
            Produit::class,
            'favoris',
            'client_id',
            'produit_id'
        )->withTimestamps();
    }

    // =========================================================================
    // RELATIONS — ESTHÉTICIENNES
    // =========================================================================

    public function rendezVousAssignes(): HasMany
    {
        return $this->hasMany(RendezVous::class, 'estheticienne_id');
    }

    public function servicesProposes(): BelongsToMany
    {
        return $this->belongsToMany(
            Service::class,
            'service_estheticienne',
            'estheticienne_id',
            'service_id'
        )->withTimestamps();
    }

    public function disponibilites(): HasMany
    {
        return $this->hasMany(Disponibilite::class, 'estheticienne_id');
    }

    public function indisponibilites(): HasMany
    {
        return $this->hasMany(Indisponibilite::class, 'estheticienne_id');
    }

    public function avisRecus(): HasMany
    {
        return $this->hasMany(Avis::class, 'estheticienne_id');
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    public function scopeParRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    public function scopeEstheticiennes($query)
    {
        return $query->where('role', 'estheticienne');
    }

    public function scopeClients($query)
    {
        return $query->where('role', 'client');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeActifs($query)
    {
        return $query->where('statut_compte', 'actif');
    }

    public function scopeEnAttenteValidation($query)
    {
        return $query->where('statut_compte', 'en_attente_validation');
    }

    public function scopeBloques($query)
    {
        return $query->where('statut_compte', 'bloque');
    }

    public function scopeSupprimes($query)
    {
        return $query->where('statut_compte', 'supprime');
    }

    /**
     * Scope : utilisateurs "vivants" (non supprimés).
     * Utilisé partout pour exclure les comptes supprimés.
     */
    public function scopeNonSupprimes($query)
    {
        return $query->where('statut_compte', '!=', 'supprime');
    }

    // =========================================================================
    // MÉTHODES MÉTIER
    // =========================================================================

    public function fullName(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    public function isMajeur(): bool
    {
        if (!$this->date_naissance) {
            return false;
        }
        return $this->date_naissance->age >= 18;
    }

    public function estActif(): bool
    {
        return $this->statut_compte === 'actif';
    }

    public function estEnAttenteValidation(): bool
    {
        return $this->statut_compte === 'en_attente_validation';
    }

    public function estBloque(): bool
    {
        return $this->statut_compte === 'bloque';
    }

    public function estSupprime(): bool
    {
        return $this->statut_compte === 'supprime';
    }

    public function peutSeConnecter(): bool
    {
        return $this->statut_compte === 'actif';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEstheticienne(): bool
    {
        return $this->role === 'estheticienne';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }
}
