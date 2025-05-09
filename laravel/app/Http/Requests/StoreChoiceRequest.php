<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Autorise toutes les requêtes pour l'instant
    }

    public function rules(): array
    {
        return [
            'label' => 'required|string|max:255', // Le texte du choix est obligatoire, doit être une chaîne et max 255 caractères
            'chapter_id' => 'required|exists:chapters,id', // L'ID du chapitre doit exister dans la table chapters
        ];
    }
}