<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use App\Rules\AlphaNumCheck;

class UserDeliveryLocationUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'max:255',
            ],
            'last_name' => [
                'required',
                'max:255',
            ],
            'first_name_kana' => [
                'required',
                'max:255',
                new AlphaNumCheck(),
            ],
            'last_name_kana' => [
                'required',
                'max:255',
                new AlphaNumCheck(),
            ],
            'zip' => [
                'required',
                'max:10',
            ],
            'address1' => [
                'required',
                'max:255',
            ],
            'tel1' => [
                'required',
                'max:13',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => __('validation_messages.required'),
            'first_name.max' => '255' . __('validation_messages.max'),
            'last_name.required' => __('validation_messages.required'),
            'last_name.max' => '255' . __('validation_messages.max'),
            'first_name_kana.required' => __('validation_messages.required'),
            'first_name_kana.max' => '255' . __('validation_messages.max'),
            'last_name_kana.required' => __('validation_messages.required'),
            'last_name_kana.max' => '255' . __('validation_messages.max'),
            'zip.required' => __('validation_messages.required'),
            'zip.max' => '10文字以内で入力してください',
            'address1.required' => __('validation_messages.required'),
            'address1.max' => '255' . __('validation_messages.max'),
            'tel1.required' => __('validation_messages.required'),
            'tel1.max' => '13文字以内で入力してください',
        ];
    }
}
