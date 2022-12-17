<?php

namespace App\Http\Requests\Api\Adminer;

use App\Enums\ContentKind;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rule;

class ContentStoreRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'kind' => [
                'required',
                Rule::in(ContentKind::getValues()),
            ],
            'content' => [
                'nullable',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
