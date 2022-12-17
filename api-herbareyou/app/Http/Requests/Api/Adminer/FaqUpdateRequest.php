<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rule;

class FaqUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'faq_category_id' => [
                'required',
                Rule::exists('faq_categories', 'id')
                    ->whereNull('deleted_at')
            ],
            'title' => [
                'required',
                'max: 255',
            ],
            'body' => [
                'required',
                'max: 2000',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
