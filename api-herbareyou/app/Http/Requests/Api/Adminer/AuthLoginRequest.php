<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;

class AuthLoginRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
