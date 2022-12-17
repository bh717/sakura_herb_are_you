<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use App\Models\ProductRecommendation;

use BenSampo\Enum\Rules\EnumValue;

class ProductRecommendationIndexRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'kind' => [
                'required',
                'int',
                // new EnumValue(ProductRecommendation::KIND),
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
