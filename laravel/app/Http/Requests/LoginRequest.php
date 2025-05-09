<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        //oblige de remplir le champ email et qu'il soit au format email et string
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function authenticate()
    {
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            throw new \Exception('Invalid credentials.');
        }
    }
}

//en gros;
//valide les données.
//gère la tentative de connexion.
//lève une erreur si les identifiants sont incorrects.