<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class CartMineRequest extends BaseApiRequest
{
    public function rules(): array
    {
        $now = Carbon::today()->format('Y-m-d H:i:s');
        return [
            'product_prices' => [
                'bail',
                'present',
                'array',
            ],
            'product_prices.*.id' => [
                'bail',
                'nullable',
                Rule::requiredIf(function () {
                    return is_array($this->product_prices) && count($this->product_prices) !== 0;
                }),
                'integer',
                // Rule::exists('product_prices', 'id'),
            ],
            'product_prices.*.num' => [
                'bail',
                'nullable',
                Rule::requiredIf(function () {
                    return is_array($this->product_prices) && count($this->product_prices) !== 0;
                }),
                'integer',
                // 'min:0'
            ],
            // 'product_prices.*.is_subtraction' => [
            //     'bail',
            //     'nullable',
            //     'boolean',
            // ],
            'coupon_code' => [
                'nullable',
                'string',
                Rule::exists('coupons', 'code')->where(function ($query) use ($now) {
                    $query->where('expired_at', '>', $now)->whereNull('deleted_at');
                }),
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
