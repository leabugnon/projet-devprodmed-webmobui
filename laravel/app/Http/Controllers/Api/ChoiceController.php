<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Http\Requests\StoreChoiceRequest;


class ChoiceController extends Controller
{
    /**
     * Crée un nouveau choix.
     *
     * @param StoreChoiceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreChoiceRequest $request)
    {
        // Valide les données et crée un nouveau choix
        $validated = $request->validated();
        $choice = Choice::create($validated);

        // Retourne une réponse JSON avec le choix créé
        return response()->json($choice, 201);
    }

    /**
     * Affiche les détails d'un choix spécifique.
     *
     * @param Choice $choice
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Choice $choice)
    {
        // Retourne une réponse JSON avec les données du choix
        return response()->json($choice, 200);
    }

    /**
     * Met à jour un choix existant.
     *
     * @param StoreChoiceRequest $request
     * @param Choice $choice
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreChoiceRequest $request, Choice $choice)
    {
        // Valide les données et met à jour le choix
        $validated = $request->validated();
        $choice->update($validated);

        // Retourne une réponse JSON avec le choix mis à jour
        return response()->json($choice, 200);
    }

    /**
     * Supprime un choix.
     *
     * @param Choice $choice
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Choice $choice)
    {
        // Supprime le choix
        $choice->delete();

        // Retourne une réponse JSON avec un code HTTP 204 (No Content)
        return response()->json(null, 204);
    }
}