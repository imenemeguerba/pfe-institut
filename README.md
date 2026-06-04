<div align="center">

<img src="public/images/Glow.png" alt="Glow Institute Logo" width="120" />

# Glow Institute

### Beauty & Wellness Management Platform

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-Academic-b480ff?style=flat-square)](#-license)

> **Final Year Project — 2025/2026**
> École Supérieure de Technologie (HST)

</div>

---

## 📌 About

**Glow Institute** is a full-stack web application for managing a beauty institute. It brings together online appointment booking, staff and schedule management, a cosmetics shop, and a complete administrative dashboard — all in one platform.

| | |
|---|---|
| **Institution** | École Supérieure de Technologie (HST) |
| **Department** | Mathematics & Computer Science |
| **Field** | Computer Science |
| **Specialty** | Information Systems |
| **Academic Year** | 2025 / 2026 |
| **Supervisor** | Mme. |
| **Student** | Meguerba Imene |

---

## ✨ Features

### 👑 Administrator
- Dashboard with KPIs, activity statistics and PDF reports
- Full catalogue management — categories, services, products & stock
- Expert application review and account validation
- Client account management (blocking, deletion, history)
- Order management — confirmation, cancellation and automatic invoicing
- Review moderation before publication
- Promo code creation and management
- Institute settings — opening hours, GPS location, social media, VAT rate
- Global availability calendar
- Account deletion request management

### 💅 Beauty Expert
- Online registration with administrator approval
- Weekly schedule and unavailability management
- Appointment handling — accept, refuse or mark as completed
- Performance dashboard and client review consultation
- Before/after gallery management

### 🛍️ Client
- Secure registration with email OTP verification (adults only)
- Service browsing and filtering by category, price or duration
- Appointment booking with expert selection or automatic assignment
- Product shop with cart, wishlist and promo codes
- Review and rating system
- Loyalty programme — Bronze / Silver / Gold tiers
- Skin type questionnaire with personalised product recommendations
- Real-time institute occupancy indicator
- Invoice download in PDF format

### ⚙️ Automated System Features
- Automatic email reminder 24 hours before each appointment
- Time slot conflict detection during booking
- Automatic invoice generation for appointments and orders
- Stock update after order confirmation
- Real-time in-app and email notifications for all users
- Automatic occupancy level calculation

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | Laravel 12 · PHP 8.2+ |
| **Database** | MySQL 8 |
| **Authentication** | Laravel Breeze + Email OTP |
| **Frontend** | Blade · Custom CSS3 · Font Awesome 6 |
| **PDF Generation** | DomPDF |
| **Emails** | Gmail SMTP · Laravel Mailables |
| **Version Control** | Git · GitHub |
| **Local Environment** | XAMPP · PHP Artisan |

---

## 🗄️ Database

The project uses a relational MySQL database with **27 business tables**:

| Module | Tables |
|---|---|
| Authentication | `users`, `registration_otps` |
| Catalogue | `categories`, `services`, `produits`, `categories_produits` |
| Pivots & Variants | `service_estheticienne`, `rendez_vous_service`, `service_variantes`, `produit_variantes`, `panier_produit`, `commande_produit` |
| Schedule | `disponibilites`, `indisponibilites` |
| Appointments | `rendez_vous` |
| E-commerce | `paniers`, `favoris`, `commandes` |
| Promotions | `codes_promo` |
| Reviews & Contact | `avis`, `messages_contact` |
| Billing | `factures` |
| Loyalty | `fidelite_points` |
| Gallery | `avant_apres` |
| System | `notifications`, `instituts`, `demandes_suppression` |

---

## 🚀 Installation

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+ & npm
- MySQL (via XAMPP or equivalent)
- Git

### Setup

```bash
# 1. Clone the repository
git clone https://github.com/imenemeguerba/pfe-institut.git
cd pfe-institut

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure the database in .env
# DB_DATABASE=pfe_institut
# DB_USERNAME=root
# DB_PASSWORD=
# DB_PORT=3307

# 7. Run migrations
php artisan migrate

# 8. Seed initial data (admin account + demo data)
php artisan db:seed

# 9. Create storage symlink
php artisan storage:link

# 10. Build assets
npm run build

# 11. Start the development server
php artisan serve
```

The application will be available at **http://127.0.0.1:8000**

### Demo Accounts

| Role | Email | Password |
|---|---|---|
| Administrator | admin@glowinstitute.com | password |
| Beauty Expert | esthe@glowinstitute.com | password |
| Client | client@glowinstitute.com | password |

---

## 📁 Project Structure

```
glow-institute/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/           # Administration controllers
│   │   ├── Client/          # Client-side controllers
│   │   ├── Estheticienne/   # Expert-side controllers
│   │   └── Auth/            # Authentication & OTP
│   ├── Mail/                # Transactional email classes
│   ├── Models/              # Eloquent models
│   └── Services/            # FactureService · FideliteService · RendezVousService
├── database/
│   ├── migrations/          # 27+ migration files
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/           # Admin panel views
│       ├── client/          # Client interface views
│       ├── estheticienne/   # Expert interface views
│       ├── emails/          # Email templates
│       └── layouts/         # Main layout & components
└── public/
    ├── css/                 # Custom stylesheets
    └── images/
```

---

## 📄 Documentation

This project is accompanied by a final year dissertation covering:

- Existing system analysis and requirements study
- System design (UML diagrams: use cases, sequence, class diagrams)
- Technical implementation
- Testing and validation

---

## 👩‍💻 Author

<div align="center">

**Meguerba Imene**
Information Systems — École Supérieure de Technologie (HST)
2025 / 2026

</div>

---

## 📜 License

Academic project developed as part of a Final Year Dissertation.
All rights reserved © 2026 — Meguerba Imene
