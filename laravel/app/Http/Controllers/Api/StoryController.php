<?php
//importations
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Http\Requests\StoreStoryRequest;

class StoryController extends Controller
{
    public function index()
    // Renvoie toutes les histoires (stories) au format JSON.
    {
        // Récupère toutes les histoires depuis la base de données et les retourne au format JSON avec un code HTTP 200 (OK).
        return response()->json(Story::all(), 200);
    }

    public function show(Story $story)
    {
        // Charge les chapitres associés à l'histoire, triés par ID croissant
        $story->load([
            'chapters' => function ($query) {
                $query->orderBy('id', 'asc'); // Tri par ID croissant
            }
        ]);

        // Retourne l'histoire avec :
        // - Tous les chapitres : Cela permet au frontend d'avoir une vue complète de l'histoire, y compris tous les chapitres associés.
        // - Le chapitre de départ (starting_chapter) : Ce chapitre est le point d'entrée de l'histoire. Il est retourné avec ses choix pour simplifier la navigation initiale dans le frontend.
        // Cette approche centralise la logique dans le backend, ce qui réduit la complexité dans le frontend et améliore les performances en évitant des requêtes supplémentaires.
        return response()->json([
            'story' => $story, // L'histoire complète
            'starting_chapter' => \App\Models\Chapter::with('choices')->find($story->chapters->first()->id), // Premier chapitre avec ses choix
        ]);
    }

    public function store(StoreStoryRequest $request)
    // Crée une nouvelle histoire après validation et renvoie l’histoire créée avec un code 201.
    {
        $story = Story::create($request->validated());

        return response()->json($story, 201);
    }

    /**
     * Supprime une histoire.
     *
     * @param Story $story
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Story $story)
    {
        // Supprime l'histoire
        $story->delete();

        // Retourne une réponse JSON avec un code HTTP 204 (No Content)
        return response()->json(null, 204);
    }
}
