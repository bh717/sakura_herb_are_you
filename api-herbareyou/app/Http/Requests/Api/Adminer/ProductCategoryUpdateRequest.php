<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;

class ProductCategoryUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'series_name' => [
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
