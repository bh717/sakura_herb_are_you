<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use App\Models\ProductRecommendation;
use BenSampo\Enum\Rules\EnumValue;

use Illuminate\Validation\Rule;

class ProductRecommendationStoreRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'product_ids' => [
                'present',
                'array',
            ],
            'product_ids.*' => [
                'nullable',
                'distinct',
                Rule::exists('products', 'id')->whereNUll('deleted_at'),
            ],
            'kind' => [
                'required',
                new EnumValue(ProductRecommendation::KIND),
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
