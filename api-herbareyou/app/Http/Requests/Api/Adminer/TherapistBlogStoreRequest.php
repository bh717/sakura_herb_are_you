<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use App\Models\TherapistBlog;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;

class TherapistBlogStoreRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'therapist_id' => [
                'required',
                'integer',
                Rule::exists('therapists', 'id')->whereNUll('deleted_at'),
            ],
            'title' => [
                'required',
                'max:255',
            ],
            'body' => [
                'required',
                'max:2000',
            ],
            'is_public' => [
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
