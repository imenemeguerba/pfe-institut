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
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Les attributs autorisés à l'écriture massive.
     */
    protected $fillable = [
    'nom',
    'prenom',
    'email',
    'role',
    'statut_compte',
    'motif_statut',
    'telephone',
    'date_naissance',
    'experience',
    'bio',
    'photo',
    'password',
];

    /**
     * Les attributs cachés lors de la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversion automatique des types.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_naissance' => 'date',
            'experience' => 'integer',
            'password' => 'hashed',
        ];
    }

    // =========================================================================
    // RELATIONS — pour TOUS les utilisateurs (peu importe le rôle)
    // =========================================================================

    /**
     * Les avis écrits par cet utilisateur (en tant que client).
     */
    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'client_id');
    }

    /**
     * Les factures de cet utilisateur (en tant que client).
     */
    public function factures(): HasMany
    {
        return $this->hasMany(Facture::class, 'client_id');
    }
    /**
     * Les demandes de suppression de cet utilisateur.
     */
    public function demandesSuppression(): HasMany
    {
        return $this->hasMany(DemandeSuppression::class);
    }

    /**
     * La demande de suppression actuelle (en attente, s'il y en a une).
     */
    public function demandeSuppressionEnCours(): ?DemandeSuppression
    {
        return $this->demandesSuppression()
            ->where('statut', 'en_attente')
            ->first();
    }

    // =========================================================================
    // RELATIONS — spécifiques aux CLIENTS
    // =========================================================================

    /**
     * Les RDV pris par ce client.
     */
    public function rendezVous(): HasMany
    {
        return $this->hasMany(RendezVous::class, 'client_id');
    }

    /**
     * Les commandes passées par ce client.
     */
    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class, 'client_id');
    }

    /**
     * Le panier du client (1:1).
     */
    public function panier(): HasOne
    {
        return $this->hasOne(Panier::class, 'client_id');
    }

    /**
     * Les produits favoris du client (N:N).
     */
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
    // RELATIONS — spécifiques aux ESTHÉTICIENNES
    // =========================================================================

    /**
     * Les RDV assignés à cette esthéticienne.
     */
    public function rendezVousAssignes(): HasMany
    {
        return $this->hasMany(RendezVous::class, 'estheticienne_id');
    }

    /**
     * Les services que cette esthéticienne maîtrise (N:N).
     */
    public function servicesProposes(): BelongsToMany
    {
        return $this->belongsToMany(
            Service::class,
            'service_estheticienne',
            'estheticienne_id',
            'service_id'
        )->withTimestamps();
    }

    /**
     * Les disponibilités hebdomadaires de cette esthéticienne.
     */
    public function disponibilites(): HasMany
    {
        return $this->hasMany(Disponibilite::class, 'estheticienne_id');
    }

    /**
     * Les indisponibilités ponctuelles (congés, maladie, etc.).
     */
    public function indisponibilites(): HasMany
    {
        return $this->hasMany(Indisponibilite::class, 'estheticienne_id');
    }

    /**
     * Les avis reçus par cette esthéticienne.
     */
    public function avisRecus(): HasMany
    {
        return $this->hasMany(Avis::class, 'estheticienne_id');
    }

    // =========================================================================
    // SCOPES
    // =========================================================================
    /**
     * Scope : comptes actifs (peuvent se connecter normalement).
     */
    public function scopeActifs($query)
    {
        return $query->where('statut_compte', 'actif');
    }

    /**
     * Scope : comptes en attente de validation (esthéticiennes).
     */
    public function scopeEnAttenteValidation($query)
    {
        return $query->where('statut_compte', 'en_attente_validation');
    }

    /**
     * Scope : comptes bloqués.
     */
    public function scopeBloques($query)
    {
        return $query->where('statut_compte', 'bloque');
    }
    /**
     * Scope : filtrer par rôle.
     */
    public function scopeParRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope : uniquement les esthéticiennes.
     */
    public function scopeEstheticiennes($query)
    {
        return $query->where('role', 'estheticienne');
    }

    /**
     * Scope : uniquement les clients.
     */
    public function scopeClients($query)
    {
        return $query->where('role', 'client');
    }

    /**
     * Scope : uniquement les admins.
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    // =========================================================================
    // MÉTHODES MÉTIER
    // =========================================================================

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
     * Vérifie si le compte est actif.
     */
    public function estActif(): bool
    {
        return $this->statut_compte === 'actif';
    }

    /**
     * Vérifie si le compte est en attente de validation admin.
     */
    public function estEnAttenteValidation(): bool
    {
        return $this->statut_compte === 'en_attente_validation';
    }

    /**
     * Vérifie si le compte est bloqué.
     */
    public function estBloque(): bool
    {
        return $this->statut_compte === 'bloque';
    }

    /**
     * Vérifie si le compte peut se connecter.
     */
    public function peutSeConnecter(): bool
    {
        return $this->statut_compte === 'actif';
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
