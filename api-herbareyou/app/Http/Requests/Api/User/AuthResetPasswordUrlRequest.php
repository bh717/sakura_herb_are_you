<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rule;

class AuthResetPasswordUrlRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'max:255',
                // Rule::exists('users', 'email')->whereNull('deleted_at'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation_messages.required'),
            'email.max' => '255' . __('validation_messages.max'),
            'email.email' => '有効なメールアドレスを入力してください',
        ];
    }
}
