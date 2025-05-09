<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Affiche les détails d'un chapitre spécifique.
     *
     * @param Chapter $chapter
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Chapter $chapter)
    {
        // Charge les relations "choices" associées au chapitre
        $chapter->load('choices');

        // Retourne les données du chapitre sous forme de réponse JSON
        return response()->json($chapter, 200);
    }

    /**
     * Supprime un chapitre.
     *
     * @param Chapter $chapter
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Chapter $chapter)
    {
        // Supprime le chapitre
        $chapter->delete();

        // Retourne une réponse JSON avec un code HTTP 204 (No Content)
        return response()->json(null, 204);
    }
}