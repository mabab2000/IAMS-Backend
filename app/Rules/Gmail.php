<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Gmail implements Rule
{
    public function passes($attribute, $value)
    {
        return strpos($value, '@gmail.com') !== false;
    }

    public function message()
    {
        return 'The :attribute must be a valid email address with the @gmail.com domain.';
    }
}
