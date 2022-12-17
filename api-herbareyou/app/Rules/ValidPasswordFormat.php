<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPasswordFormat implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        // 「英大文字」「英小文字」「数字」「記号」が必須
        return preg_match(
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\-+=^$*.\[\]{}()?\"!@#%&\/\\\\,><\':;|_~`\-+=])(?!.*[^a-zA-Z\d\-+=^$*.\[\]{}()?\"!@#%&\/\\\\,><\':;|_~`]).+$/',
            $value
        );
    }

    public function message()
    {
        return '半角英小文字、半角英大文字、半角数字、特殊記号をそれぞれ1文字以上含めてください。特殊記号は、 ^ $ * . [ ] { } ( ) ? " ! @ # % & / \ , > < \' : ; | _ ~ ` です。';
    }
}
