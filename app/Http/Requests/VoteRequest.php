<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
{
   
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'bail|required',
            'cpf' => 'bail|required|regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
            'phone' => 'bail|required|required|regex:/^\(\d{2}\)\s\d{4,5}\-\d{4}$/',
            'candidate' => 'bail|required|exists:candidates,id',
            'recaptcha' => 'bail|required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'O campo nome é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.cpf' => 'O CPF informado é inválido.',
            'cpf.regex' => 'O CPF informado é inválido.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.regex' => 'O campo telefone é inválido.',
            'candidate.required' => 'O candidato é obrigatório.',
            'candidate.exists' => 'O candidato informado não existe.',
        ];
    }
}
