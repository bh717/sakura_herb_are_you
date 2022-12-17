<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;

class UploadFileGetPreSignedUrlRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'file_name' => [
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
