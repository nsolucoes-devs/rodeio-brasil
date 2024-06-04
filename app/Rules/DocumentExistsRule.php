<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentExistsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = str_replace(['.', '-'], '', $value);
        $documentExists = User::where('document', $value)->first();

        if ($documentExists) {
            $fail('O documento informado já está cadastrado');
        }
    }
}
