<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use App\Models\TherapistBlog;
use BenSampo\Enum\Rules\EnumValue;

class TherapistBlogUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'max:255',
            ],
            'body' => [
                'required',
                'max:2000',
            ],
            'is_public' => [
                'required',
                'integer',
                new EnumValue(TherapistBlog::IS_PUBLIC),
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
