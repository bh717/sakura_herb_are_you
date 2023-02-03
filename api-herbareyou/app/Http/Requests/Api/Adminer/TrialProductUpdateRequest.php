<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use App\Models\TrialProduct;

use BenSampo\Enum\Rules\EnumValue;

class TrialProductUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name1' => [
                'required',
                'max:255',
            ],
            'name2' => [
                'required',
                'max:255',
            ],
            'description' => [
                'required',
                'max:500',
            ],
            'is_public' => [
                'required',
                new EnumValue(TrialProduct::IS_PUBLIC),
            ],
            'is_productStatus' => [
                'required',
                new EnumValue(TrialProduct::IS_PRODUCT_STATUS),
            ],
            'capacity' => [
                'required',
                'string',
                'max:255',
            ],
            'prices' => [
                'required',
                'array',
            ],
            'prices.*.capacity' => [
                'required',
                'max:255',
            ],
            'prices.*.price' => [
                'required',
                'int',
            ],
            'prices.*.sort_order' => [
                'required',
                'int',
            ],
            'taste_ids' => [
                'required',
                'array',
                'present',
            ],
            'taste_ids.*' => [
                'required',
                'integer',
                'exists:tastes,id'
            ],
            'flavor_ids' => [
                'required',
                'array',
                'present',
            ],
            'flavor_ids.*' => [
                'required',
                'integer',
                'exists:flavors,id'
            ],
            'material_ids' => [
                'required',
                'array',
                'present',
            ],
            'material_ids.*' => [
                'integer',
                'exists:materials,id'
            ],
            'symptom_ids' => [
                'required',
                'array',
                'present',
            ],
            'symptom_ids.*' => [
                'integer',
                'exists:symptoms,id'
            ],
            'product_category_id' => [
                'required',
                'integer',
                'exists:product_categories,id'
            ],
            'keyword_csv' => [
                'present',
                'nullable',
                'string',
            ],
            'product_no' => [
                'required',
                'max:10',
            ],
            'upload_file_hashs' => [
                'required',
                'array'
            ],
            'upload_file_hashs.*' => [
                'exists:upload_files,hash'
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
