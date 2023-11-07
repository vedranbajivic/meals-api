<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WithValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        $words = explode(',', $value);
        if (count($words) !== count(array_unique($words))) {
            return false;
        }
        $allowedWords = ['category', 'tags', 'ingredients'];
        foreach ($words as $word) {
            if (!in_array($word, $allowedWords)) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'With parametar nije u redu.';
    }
}