<?php

namespace App\Http\Requests\Auth;

use App\Rules\DocumentExistsRule;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//            'g-recaptcha-response' => [
//                new Recaptcha(),
//            ],
            'name' => ['required', 'string', 'min:3', 'max:255',],
            'email' => ['required', 'email', 'unique:users,email', 'string',],
            'phone' => ['required',],
            'document' => ['required', 'size:14', new DocumentExistsRule],
            'password' => ['required', 'min:8', 'confirmed',],
            'password_confirmation' => ['required',],
            'use_terms_accepted' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return [
            'document.required' => 'O campo CPF/CNPJ é obrigatório.',
            'document.size' => 'O campo CPF/CNPJ deve ter :size caracteres.',
            'document.exists' => 'O CPF/CNPJ informado já está cadastrado.',
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um e-mail válido.',
            'email.unique' => 'O e-mail informado já está cadastrado.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'As senhas não conferem.',
            'password_confirmation.required' => 'O campo confirmar senha é obrigatório.',
            'use_terms_accepted.required' => 'Você deve aceitar os termos de uso.',
        ];
    }
}
