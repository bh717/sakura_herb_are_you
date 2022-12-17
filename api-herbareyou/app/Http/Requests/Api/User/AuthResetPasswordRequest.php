<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rule;

class AuthResetPasswordRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                Rule::exists('user_reset_passwords', 'code')->whereNull('deleted_at'),
            ],
            'password' => [
                'required',
                'max:255',
                'CustomPassword',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => __('validation_messages.required'),
            'code.exists' => 'パスワード再設定のurlが正しくありません。',
            'password.required' => __('validation_messages.required'),
            'password.max' => '255' . __('validation_messages.max'),
            'password.CustomPassword' => '正しいパスワードで入力してください',
        ];
    }
}
