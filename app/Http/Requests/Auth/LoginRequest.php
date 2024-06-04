<?php

namespace App\Http\Requests\Auth;

use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'g-recaptcha-response' => new Recaptcha
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Por favor, preencha o email.',
            'email.email' => 'O email deve ser um email válido.',
            'email.exists' => 'O email informado não está cadastrado.',
            'password.required' => 'Por favor, preencha a senha.',
        ];
    }
}
