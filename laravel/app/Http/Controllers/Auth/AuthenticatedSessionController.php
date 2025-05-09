<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        \Log::info('Tentative de connexion :', $request->all());
    
        try {
            $request->authenticate();
            $request->session()->regenerate();
    
            \Log::info('Connexion réussie pour l\'utilisateur :', ['user' => Auth::user()]);
    
            return response()->noContent(); // 204 No Content
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la connexion :', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        \Log::info('Déconnexion en cours pour l\'utilisateur :', ['user' => Auth::user()]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        \Log::info('Déconnexion réussie.');

        return response()->noContent(); // 204 No Content
    }

}
