<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChapterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Autorise toutes les requêtes pour l'instant
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255', // Le titre du chapitre est obligatoire, doit être une chaîne et max 255 caractères
            'content' => 'required|string', // Le contenu du chapitre est obligatoire et doit être une chaîne
            'story_id' => 'required|exists:stories,id', // L'ID de l'histoire doit exister dans la table stories
        ];
    }
}