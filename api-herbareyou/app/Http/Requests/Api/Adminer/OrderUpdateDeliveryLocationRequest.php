<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use App\Rules\AlphaNumCheck;

class OrderUpdateDeliveryLocationRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'user_delivery_location_first_name' => [
                'required',
                'max:255',
            ],
            'user_delivery_location_last_name' => [
                'required',
                'max:255',
            ],
            'user_delivery_location_first_name_kana' => [
                'required',
                'max:255',
                new AlphaNumCheck(),
            ],
            'user_delivery_location_last_name_kana' => [
                'required',
                'max:255',
                new AlphaNumCheck(),
            ],
            'user_delivery_location_zip' => [
                'required',
                'max:10',
            ],
            'user_delivery_location_address1' => [
                'required',
                'max:255',
            ],
            'user_delivery_location_tel1' => [
                'required',
                'max:13',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_delivery_location_first_name.required' => __('validation_messages.required'),
            'user_delivery_location_first_name.max' => '255' . __('validation_messages.max'),
            'user_delivery_location_last_name.required' => __('validation_messages.required'),
            'user_delivery_location_last_name.max' => '255' . __('validation_messages.max'),
            'user_delivery_location_first_name_kana.required' => __('validation_messages.required'),
            'user_delivery_location_first_name_kana.max' => '255' . __('validation_messages.max'),
            'user_delivery_location_last_name_kana.required' => __('validation_messages.required'),
            'user_delivery_location_last_name_kana.max' => '255' . __('validation_messages.max'),
            'user_delivery_location_password.required' => __('validation_messages.required'),
            'user_delivery_location_password.max' => '255' . __('validation_messages.max'),
            'user_delivery_location_password.CustomPassword' => '正しいパスワードで入力してください',
            'user_delivery_location_zip.required' => __('validation_messages.required'),
            'user_delivery_location_zip.max' => '10文字以内で入力してください',
            'user_delivery_location_address1.required' => __('validation_messages.required'),
            'user_delivery_location_address1.max' => '255' . __('validation_messages.max'),
            'user_delivery_location_tel1.required' => __('validation_messages.required'),
            'user_delivery_location_tel1.max' => '13文字以内で入力してください',
        ];
    }
}
