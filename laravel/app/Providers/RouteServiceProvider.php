<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Chemin d'accès à la page d'accueil après connexion.
     */
    public const HOME = '/dashboard';

    /**
     * Définition des routes de l'application.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('') 
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
