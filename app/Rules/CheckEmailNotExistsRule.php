<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class CheckEmailNotExistsRule implements ValidationRule
{
    /**
     * Validate that email doesn't exist
     * 
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Validation\ValidationRule::validate()
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = DB::table('user')
            ->where('EMAIL', $value)
            ->where('STATUS', 'USING')
            ->exists();
            
        if ($exists) {
            $locale = app()->getLocale();
            $messages = json_decode(file_get_contents(resource_path("lang/{$locale}/validation.json")), true);
            $fail($messages['email_exists'] ?? 'Email đã tồn tại.');
        }
    }
}
