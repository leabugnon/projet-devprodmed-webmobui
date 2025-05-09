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
php artisan db:seed
php artisan serve
```

> 🔁 configuration `.env` avec :

⚠️ remplacez 5173 par le bon port ⚠️

```env
SANCTUM_STATEFUL_DOMAINS=localhost:5173
SESSION_DOMAIN=localhost
FRONTEND_URL=http://localhost:5173
```

> 🔁 configuration `.env` avec :
> 'allowed_origins' => [

    'http://localhost:5173',

],

### Frontend (Vue)

```bash
cd front
npm install
npm run dev
```

## 🔁 API Principales

-   `POST /login` – Connexion
-   `POST /logout` – Déconnexion
-   `GET /api/users-debug` – liste des utilisateurs
-   `GET /api/v1/stories` – Liste des histoires
-   `GET /api/v1/stories/{id}` – Liste une histoire
-   `GET /api/chapters/{id}` – Voir un chapitre avec ses choix

## 📁 Structure

-   `laravel/` – Backend Laravel
-   `front/` – Frontend Vue.js
