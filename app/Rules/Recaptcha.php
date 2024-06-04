<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::asForm()->post(config('services.recaptcha.url'), [
            'secret' => config('services.recaptcha.secret'),
            'response' => $value,
        ]);

        if (! $response->json()['success']) {
            $fail('reCAPTCHA precisa ser preenchido!');
        }
    }
}
