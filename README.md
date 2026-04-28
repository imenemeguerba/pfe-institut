# 💄 Création d'un site web dédié à la gestion d'un institut de beauté

> Projet de Fin d'Études — 2025/2026

Application web complète permettant la gestion d'un institut de beauté : réservation de rendez-vous en ligne, gestion des services et du personnel, vente de produits cosmétiques, et tableau de bord administrateur.

---

## 📋 À propos

| | |
|---|---|
| **École** | École Supérieure de Technologie (HST) |
| **Domaine** | Mathematics & Computer Science |
| **Filière** | Computer Science |
| **Spécialité** | Informatic Systems |
| **Année universitaire** | 2025 / 2026 |
| **Encadrante** | Mme.  |
| **Étudiante** | Meguerba Imene |

---

## 🎯 Objectifs du projet

Le projet vise à digitaliser la gestion d'un institut de beauté à travers une plateforme web qui permet :

- Aux **clientes** de réserver leurs prestations en ligne, consulter les services, acheter des produits cosmétiques et laisser des avis
- Aux **esthéticiennes** de gérer leur planning, traiter leurs rendez-vous et suivre leurs performances
- À l'**administrateur** de superviser l'ensemble de l'activité : services, personnel, commandes, statistiques et facturation

---

## ✨ Fonctionnalités principales

### 👤 Espace Cliente
- Inscription et authentification sécurisées (réservée aux personnes majeures)
- Consultation et filtrage des services par catégorie, prix ou durée
- Réservation de rendez-vous avec choix de l'esthéticienne
- Gestion du panier et achat de produits cosmétiques
- Système de favoris
- Dépôt d'avis et notation des prestations
- Consultation du niveau d'affluence en temps réel
- Historique des rendez-vous et téléchargement de factures PDF

### 💅 Espace Esthéticienne
- Inscription avec validation par l'administrateur
- Gestion du planning et des disponibilités
- Traitement des demandes de rendez-vous (accepter, refuser, reporter)
- Consultation des performances et avis clients
- Marquage des rendez-vous comme réalisés

### ⚙️ Espace Administrateur
- Gestion complète du catalogue (catégories, services, produits)
- Validation des inscriptions des esthéticiennes
- Gestion des comptes (clientes et esthéticiennes)
- Modération des avis avant publication
- Gestion des commandes et du stock
- Création de codes promotionnels
- Tableau de bord avec statistiques et indicateurs
- Génération automatique de factures et rapports PDF

### 🤖 Fonctionnalités automatiques
- Rappel automatique 24h avant chaque rendez-vous
- Vérification des conflits de créneaux
- Calcul automatique de la durée totale d'un rendez-vous
- Mise à jour automatique du stock après confirmation de commande
- Notifications en temps réel pour tous les acteurs
- Calcul automatique du niveau d'affluence

---

## 🛠️ Technologies utilisées

### Backend
| Technologie | Rôle |
|---|---|
| **Laravel 12** | Framework PHP principal |
| **PHP 8.2+** | Langage backend |
| **MySQL** | Système de gestion de base de données |
| **Laravel Breeze** | Système d'authentification |

### Frontend
| Technologie | Rôle |
|---|---|
| **HTML5** | Structure des pages |
| **CSS3** | Stylisation personnalisée |
| **Blade** | Moteur de template Laravel |
| **Tailwind CSS** | Stylisation des pages d'authentification (Breeze) |

### Outils
| Outil | Rôle |
|---|---|
| **Node.js** | Environnement d'exécution JavaScript |
| **npm** | Gestionnaire de paquets |
| **XAMPP** | Serveur local (MySQL) |
| **Git & GitHub** | Versioning et hébergement du code |
| **Visual Studio Code** | Éditeur de code |

---

## 🗄️ Architecture de la base de données

Le projet repose sur une base de données relationnelle MySQL composée de **17 tables métier** organisées en modules :

- **Authentification** : `users`
- **Catalogue** : `categories`, `services`, `produits`
- **Compétences** : `service_estheticienne`
- **Planning** : `disponibilites`, `indisponibilites`
- **Réservations** : `rendez_vous`, `rendez_vous_service`
- **E-commerce** : `paniers`, `panier_produit`, `favoris`, `commandes`, `commande_produit`
- **Promotions** : `codes_promo`
- **Avis** : `avis`
- **Facturation** : `factures`
- **Système** : `notifications`

---

## 🚀 Installation

### Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js (v18+) et npm
- MySQL (via XAMPP ou autre)
- Git

### Étapes d'installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/imenemeguerba/pfe-institut.git
cd pfe-institut

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JavaScript
npm install

# 4. Créer le fichier .env
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Configurer la base de données dans .env
# DB_DATABASE=pfe_institut
# DB_USERNAME=root
# DB_PASSWORD=
# DB_PORT=3307

# 7. Exécuter les migrations
php artisan migrate

# 8. Insérer les données initiales (admin + catégories)
php artisan db:seed

# 9. Compiler les assets
npm run build

# 10. Lancer le serveur
php artisan serve
```

L'application sera accessible sur `http://127.0.0.1:8000`

---

## 📅 État d'avancement

- [x] Configuration de l'environnement de développement
- [x] Conception de la base de données (17 tables)
- [x] Migrations Laravel complètes
- [x] Système d'authentification (Laravel Breeze)
- [ ] Models Eloquent et relations
- [ ] Seeders et données de test
- [ ] Controllers et logique métier
- [ ] Interface utilisateur (Views Blade)
- [ ] Tests fonctionnels
- [ ] Déploiement

---

## 📄 Documentation

Ce projet est accompagné d'un mémoire de fin d'études détaillant :
- Étude de l'existant
- L'analyse des besoins
- La conception (diagrammes UML : cas d'utilisation, séquences, classes)
- L'implémentation
- Les tests et la validation

---

## 👤 Auteur

**Meguerba Imene**
Étudiante en Informatic Systems
École Supérieure de Technologie (HST)

---

## 📜 Licence

Projet académique réalisé dans le cadre du Projet de Fin d'Études — Tous droits réservés © 2026
