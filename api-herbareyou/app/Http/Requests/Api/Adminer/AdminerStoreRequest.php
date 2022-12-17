<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;

class AdminerStoreRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'name' => [
                'required',
                'max:255',
            ],
            'password' => [
                'required',
                'CustomPassword',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
