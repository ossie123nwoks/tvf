<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidYouTubeUrl implements ValidationRule
{
    /**
     * Validate the attribute.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            return;
        }

        // Check if URL matches YouTube patterns
        $patterns = [
            '~^(https?://)?(www\.)?(youtube\.com|youtu\.be)/~i',
            '~^https?://(www\.)?youtube\.com/embed/~i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return; // Valid YouTube URL
            }
        }

        $fail('The :attribute must be a valid YouTube URL.');
    }
}