# 📖 Fiction Interactive

Une application web fullstack qui permet de créer, gérer et lire des histoires interactives à choix multiples.  
Développée avec **Laravel (API)** et **Vue.js (frontend)**.

## 🚀 Fonctionnalités

-   🔐 Authentification via Laravel Sanctum
-   👤 Création et connexion d'utilisateur
-   📝 Création d'histoires, chapitres et choix
-   🔗 Navigation interactive entre les chapitres selon les choix
-   🛡️ Protection des routes sensibles avec middleware `auth:sanctum`

## 🧱 Technologies

-   Backend : Laravel, Sanctum
-   Frontend : Vue.js , Vite
-   Base de données : SQLite (par défaut)
-   Authentification : Sanctum

## 🛠️ Installation

### Backend (Laravel)

```bash
cd laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

> 🔁 configuration `.env` avec :

```env
SANCTUM_STATEFUL_DOMAINS=localhost:5173
SESSION_DOMAIN=localhost
FRONTEND_URL=http://localhost:5173
```

### Frontend (Vue)

```bash
cd front
npm install
npm run dev
```

## 🔁 API Principales

-   `POST /login` – Connexion
-   `POST /logout` – Déconnexion
-   `GET /api/users-debug` – utilisateurs
-   `GET /api/v1/stories` – Liste des histoires
-   `POST /api/v1/stories` – Créer une histoire (auth)
-   `GET /api/chapters/{id}` – Voir un chapitre avec ses choix

## 📁 Structure

-   `laravel/` – Backend Laravel
-   `front/` – Frontend Vue.js
