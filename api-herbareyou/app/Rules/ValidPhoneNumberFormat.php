<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhoneNumberFormat implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        return preg_match('/\A0\d{9,10}\z/', $value);
    }

    public function message()
    {
        return '電話番号は有効な形式である必要があります';
    }
}
