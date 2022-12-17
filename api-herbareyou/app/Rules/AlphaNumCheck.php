<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaNumCheck implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        // 半角英数文字のみ
        return preg_match('/^[a-zA-Z0-9]+$/', $value);
    }

    public function message()
    {
        return '半角英数字ではありません。';
    }
}
