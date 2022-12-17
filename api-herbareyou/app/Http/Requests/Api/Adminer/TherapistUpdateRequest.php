<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;

class TherapistUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'name_kana' => [
                'required',
                'max:255',
            ],
            'profile' => [
                'required',
                'max:500',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
