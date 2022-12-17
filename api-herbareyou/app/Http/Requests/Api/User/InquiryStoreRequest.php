<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;

class InquiryStoreRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max: 255',
            ],
            'email' => [
                'required',
                'email',
                'max: 255',
            ],
            'order_no' => [
                'nullable',
                'max: 255',
            ],
            'inquiry' => [
                'required',
                'max: 2000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation_messages.required'),
            'name.max' => '255文字以内で入力してください',
            'email.required' => __('validation_messages.required'),
            'email.email' => '有効なメールアドレスを入力してください',
            'email.max' => '255文字以内で入力してください',
            'order_no.max' => '255文字以内で入力してください',
            'inquiry.required' => __('validation_messages.required'),
            'inquiry.max' => '2000文字以内で入力してください',
        ];
    }
}
