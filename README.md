<div align="center">

<img src="public/images/Glow.png" alt="Glow Institute Logo" width="120" />

# Glow Institute

### Beauty & Wellness Management Platform

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/Licence-Académique-b480ff?style=flat-square)](#-licence)

> **Projet de Fin d'Études — 2025/2026**
> École Supérieure de Technologie (HST)

</div>

---

## 📌 À propos

**Glow Institute** est une application web complète dédiée à la gestion d'un institut de beauté. Elle centralise la réservation de rendez-vous en ligne, la gestion du personnel, la vente de produits cosmétiques et le pilotage de l'activité via un tableau de bord administrateur.

| | |
|---|---|
| **École** | École Supérieure de Technologie (HST) |
| **Domaine** | Mathématiques & Informatique |
| **Filière** | Informatique |
| **Spécialité** | Systèmes Informatiques |
| **Année universitaire** | 2025 / 2026 |
| **Encadrante** | Mme. |
| **Étudiante** | Meguerba Imene |

---

## ✨ Fonctionnalités

### 👑 Administrateur
- Tableau de bord avec KPIs, statistiques et rapports PDF
- Gestion du catalogue — catégories, services, produits & stock
- Validation des inscriptions des esthéticiennes
- Gestion des clients (blocage, suppression, historique)
- Gestion des commandes avec confirmation, annulation et facturation automatique
- Modération des avis avant publication
- Création et gestion de codes promotionnels
- Paramétrage de l'institut (horaires, GPS, réseaux sociaux, TVA)
- Calendrier global des disponibilités
- Gestion des demandes de suppression de compte

### 💅 Esthéticienne
- Inscription en ligne avec validation administrateur
- Gestion du planning hebdomadaire et des indisponibilités
- Traitement des rendez-vous (accepter, refuser, reporter, marquer comme réalisé)
- Consultation des performances et des avis clients
- Galerie avant/après

### 🛍️ Cliente
- Inscription sécurisée avec vérification OTP par email (réservée aux majeures)
- Consultation et filtrage des services (catégorie, prix, durée)
- Réservation de rendez-vous avec choix de l'esthéticienne ou attribution automatique
- Boutique de produits avec panier, favoris et codes promo
- Système d'avis et de notation
- Programme de fidélité (points Bronze / Silver / Gold)
- Questionnaire de type de peau avec recommandations personnalisées
- Consultation du niveau d'affluence en temps réel
- Téléchargement des factures en PDF

### ⚙️ Automatisations système
- Rappel automatique par email 24h avant chaque rendez-vous
- Vérification des conflits de créneaux lors de la réservation
- Génération automatique des factures (RDV + commandes)
- Mise à jour du stock après confirmation de commande
- Notifications in-app et email pour tous les acteurs
- Calcul automatique du niveau d'affluence

---

## 🛠️ Stack technique

| Couche | Technologie |
|---|---|
| **Backend** | Laravel 12 · PHP 8.2+ |
| **Base de données** | MySQL 8 |
| **Authentification** | Laravel Breeze + OTP email |
| **Frontend** | Blade · CSS3 personnalisé · Font Awesome 6 |
| **PDF** | DomPDF (Laravel Snappy) |
| **Emails** | SMTP Gmail · Mailable Laravel |
| **Versioning** | Git · GitHub |
| **Environnement** | XAMPP · PHP Artisan |

---

## 🗄️ Base de données

Le projet repose sur **30+ tables** organisées en modules fonctionnels :

| Module | Tables |
|---|---|
| Authentification | `users`, `registration_otps` |
| Catalogue | `categories`, `services`, `produits`, `categories_produits` |
| Variantes | `service_variantes`, `produit_variantes` |
| Planning | `disponibilites`, `indisponibilites` |
| Réservations | `rendez_vous`, `rendez_vous_service` |
| E-commerce | `paniers`, `panier_produit`, `favoris`, `commandes`, `commande_produit` |
| Promotions | `codes_promo` |
| Avis & Contact | `avis`, `messages_contact` |
| Facturation | `factures` |
| Fidélité | `fidelite_points` |
| Galerie | `avant_apres` |
| Système | `notifications`, `instituts`, `demandes_suppression` |

---

## 🚀 Installation

### Prérequis

- PHP 8.2+
- Composer
- Node.js 18+ & npm
- MySQL (via XAMPP ou autre)
- Git

### Étapes

```bash
# 1. Cloner le dépôt
git clone https://github.com/imenemeguerba/pfe-institut.git
cd pfe-institut

# 2. Dépendances PHP
composer install

# 3. Dépendances JavaScript
npm install

# 4. Variables d'environnement
cp .env.example .env

# 5. Clé d'application
php artisan key:generate

# 6. Base de données — configurer .env
# DB_DATABASE=pfe_institut
# DB_USERNAME=root
# DB_PASSWORD=
# DB_PORT=3307

# 7. Migrations
php artisan migrate

# 8. Données initiales (admin + données de démo)
php artisan db:seed

# 9. Lien de stockage
php artisan storage:link

# 10. Assets
npm run build

# 11. Lancer le serveur
php artisan serve
```

L'application sera accessible sur **http://127.0.0.1:8000**

### Comptes de démonstration

| Rôle | Email | Mot de passe |
|---|---|---|
| Administrateur | admin@glowinstitute.com | password |
| Esthéticienne | esthe@glowinstitute.com | password |
| Cliente | client@glowinstitute.com | password |

---

## 📁 Structure du projet

```
glow-institute/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # 15 controllers admin
│   │   ├── Client/         # 14 controllers client
│   │   ├── Estheticienne/  # 8 controllers esthéticienne
│   │   └── Auth/           # Authentification + OTP
│   ├── Mail/               # 10 templates email
│   ├── Models/             # 20+ modèles Eloquent
│   └── Services/           # FactureService · FideliteService · RendezVousService
├── database/
│   ├── migrations/         # 30+ migrations
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/          # Toutes les vues admin
│       ├── client/         # Toutes les vues client
│       ├── estheticienne/  # Toutes les vues esthéticienne
│       ├── emails/         # Templates emails transactionnels
│       └── layouts/        # Layout principal + composants
└── public/
    ├── css/                # Feuilles de style personnalisées
    └── images/
```

---

## 📄 Documentation

Ce projet est accompagné d'un mémoire de fin d'études détaillant :

- Étude de l'existant et analyse des besoins
- Conception (diagrammes UML : cas d'utilisation, séquences, classes)
- Implémentation et choix techniques
- Tests et validation

---

## 👩‍💻 Auteure

<div align="center">

**Meguerba Imene**
Étudiante en Systèmes Informatiques
École Supérieure de Technologie (HST) — 2025/2026

</div>

---

## 📜 Licence

Projet académique réalisé dans le cadre du Projet de Fin d'Études.
Tous droits réservés © 2026 — Meguerba Imene
