<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;

class UserMailMagazineRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'subject' => [
                'required',
                'max:255',
            ],
            'body' => [
                'required',
                'max:1000',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
