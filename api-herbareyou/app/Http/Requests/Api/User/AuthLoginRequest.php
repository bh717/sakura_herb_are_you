<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;

class AuthLoginRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation_messages.required'),
            'email.email' => '有効なメールアドレスを入力してください',
            'email.max' => '255' . __('validation_messages.max'),
            'password.required' => __('validation_messages.required'),
        ];
    }
}
