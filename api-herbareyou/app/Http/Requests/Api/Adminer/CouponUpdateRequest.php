<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rule;

class CouponUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('coupons', 'code')
                    ->whereNull('deleted_at')
                    ->whereNot('id', $this->coupon->id),
            ],
            'discount_price' => [
                'required',
                'integer',
            ],
            'expired_at' => [
                'required',
                'date_format:Y-m-d H:i:s',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
