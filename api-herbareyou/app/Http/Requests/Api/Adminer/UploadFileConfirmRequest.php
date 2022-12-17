<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;

class UploadFileConfirmRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'hash' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
