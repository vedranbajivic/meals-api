<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CategoryValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        if($value=="NULL" || $value=="!NULL" || is_numeric($value)){
            return true;
        }else{
            return false;
        }
    }

    public function message()
    {
        return 'Category parametar nije u redu.';
    }
}