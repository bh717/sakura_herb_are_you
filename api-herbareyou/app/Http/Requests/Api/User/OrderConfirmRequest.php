<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rule;

class OrderConfirmRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'order_no' => [
                'required',
                Rule::exists('orders', 'order_no')
                    ->whereNUll('deleted_at')
                    ->where('user_id', auth()->id())
            ],
            'trans_code' => [
                'required',
            ],
            'result' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }
}
