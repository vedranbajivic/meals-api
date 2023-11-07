<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PositiveIntegerRule implements Rule
{
    public function passes($attribute, $value)
    {
        return $value > 0 && $value == (int) $value;
    }

    public function message()
    {
        return 'Parametar mora biti pozitivan broj';
    }
}