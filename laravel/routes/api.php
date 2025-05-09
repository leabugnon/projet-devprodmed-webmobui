<?php

// Résumé des routes API :
// - /login : Permet à un utilisateur de se connecter via une requête POST.
// - /logout : Permet à un utilisateur connecté de se déconnecter (protégé par Sanctum).
// - /v1/stories : Retourne la liste de toutes les histoires disponibles.
// - /v1/stories/{story} : Retourne les détails d'une histoire spécifique, y compris ses chapitres.
// - /v1/chapters/{chapter} : Retourne les détails d'un chapitre spécifique.
// - /users-debug : Retourne la liste de tous les utilisateurs (debug).
// - /user : Retourne les informations de l'utilisateur connecté (protégé par Sanctum).
// - /settings/welcome-message (GET) : Retourne le message d'accueil actuel.
// - /settings/welcome-message (PUT) : Met à jour le message d'accueil (protégé par Sanctum).

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\ChapterController;
use App\Models\User;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\SettingController;
use App\Models\Setting;

// Route publique pour login via API
// Permet à un utilisateur de se connecter via une requête POST
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route pour la déconnexion
// Protégée par Sanctum, elle permet à un utilisateur connecté de se déconnecter
Route::middleware('auth:sanctum')->post('/logout', [AuthenticatedSessionController::class, 'destroy']);

// Accès aux histoires et chapitres
// Ces routes sont publiques et permettent de récupérer les histoires et leurs chapitres
Route::prefix('v1')->group(function () {
    // Liste toutes les histoires disponibles
    Route::get('/stories', [StoryController::class, 'index']);

    // Affiche les détails d'une histoire spécifique (par son ID)
    Route::get('/stories/{story}', [StoryController::class, 'show']);

    // Affiche les détails d'un chapitre spécifique (par son ID)
    Route::get('/chapters/{chapter}', [ChapterController::class, 'show']);
});

// liste des utilisateurs
Route::get('/users-debug', function () {
    return User::all(); // liste de tous les users
});

//utilisateur connecté
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//mofification du message d'accueil
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/settings/welcome-message', [SettingController::class, 'updateWelcomeMessage']);
});

Route::get('/settings/welcome-message', function () {
    $setting = Setting::first();
    return response()->json([
        'welcome_message' => $setting ? $setting->welcome_message : 'Bienvenue sur notre application !',
    ], 200);
});