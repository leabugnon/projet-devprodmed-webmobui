<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // tu peux mettre un check ici si besoin
    }

    public function rules(): array
    {
        //oblige de remplir le champ title et qu'il soit au format string et max 255 caractères
        //oblige de remplir le champ description et qu'il soit au format string
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }
}
