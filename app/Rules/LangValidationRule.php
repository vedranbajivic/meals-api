<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LangValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        $localesConfig = config('translatable.locales');
        if(in_array($value,$localesConfig)) return true;
        return false;
    }

    public function message()
    {
        return 'Lang parametar nije u redu.';
    }
}