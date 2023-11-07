<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TagsValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        $numbers = explode(',', $value);
        if (count($numbers) !== count(array_unique($numbers))) {
            return false; 
        }
        foreach ($numbers as $number) {
            if (!is_numeric($number)) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'Tags parametar nije u redu.';
    }
}