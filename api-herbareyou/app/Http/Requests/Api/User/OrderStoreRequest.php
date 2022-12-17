<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use App\Rules\CanUseCoupon;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends BaseApiRequest
{
    public function rules(): array
    {
        $now = Carbon::today()->format('Y-m-d H:i:s');
        return [
            'product_prices' => [
                'bail',
                'required',
                'array',
            ],
            'product_prices.*.id' => [
                'bail',
                'integer',
                Rule::exists('product_prices', 'id')->whereNull('deleted_at'),
            ],
            'product_prices.*.num' => [
                'bail',
                'required',
                'integer',
                'min:0'
            ],
            'coupon_code' => [
                'bail',
                'nullable',
                'string',
                // new CanUseCoupon($this->product_prices), // クーポンが使用できるかどうか
                Rule::exists('coupons', 'code')->where(function ($query) use ($now) {
                    $query->where('expired_at', '>', $now)->whereNull('deleted_at');
                }),
            ],
            'delivered_at' => [
                'bail',
                'nullable',
                'date',
                'after:' . Carbon::tomorrow()->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'delivered_at.date' => '日付を指定してください',
            'delivered_at.after' => '未来の日付を指定してください',
            'coupon_code.required' => __('validation_messages.required'),
            'coupon_code.exists' => '有効なクーポンコードをお願いします。',
        ];
    }
}
