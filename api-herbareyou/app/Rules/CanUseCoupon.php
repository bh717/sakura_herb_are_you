<?php

namespace App\Rules;

use App\Models\Coupon;
use App\Models\ProductPrice;
use Illuminate\Contracts\Validation\Rule;

// クーポンが使えるかどうか
class CanUseCoupon implements Rule
{
    private $productPrices;

    public function __construct(
        $productPrices
    ) {
        $this->productPrices = $productPrices;
    }

    public function passes($attribute, $value)
    {
        if (!is_array($this->productPrices)) {
            return true;
        }
        if (count($this->productPrices) === 0) {
            return true;
        }

        $totalPrice = 0;
        foreach ($this->productPrices as $productPriceData) {
            $productPrice = ProductPrice::find($productPriceData['id']);
            $totalPrice += $productPrice->price * $productPriceData['num'];
        }
        return Coupon::canUseCoupon($totalPrice);
    }

    public function message()
    {
        return 'クーポンの使用は商品の合計金額が' . config('order.coupon_usable_amount') . '円以上になります' ;
    }
}
