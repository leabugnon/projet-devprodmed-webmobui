<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Met à jour le message d'accueil.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateWelcomeMessage(Request $request)
    {
        $validated = $request->validate([
            'welcome_message' => 'required|string|max:255',
        ]);

        // Met à jour le message d'accueil (on suppose qu'il y a une seule ligne dans la table settings)
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create(['welcome_message' => $validated['welcome_message']]);
        } else {
            $setting->update(['welcome_message' => $validated['welcome_message']]);
        }

        return response()->json(['message' => 'Message d\'accueil mis à jour avec succès !', 'data' => $setting], 200);
    }
}