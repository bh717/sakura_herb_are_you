<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;

class TasteUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'name' => [
                'required',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
