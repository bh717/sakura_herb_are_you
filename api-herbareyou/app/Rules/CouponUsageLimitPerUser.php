<?php

namespace App\Rules;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Contracts\Validation\Rule;

// ユーザーごとのクーポンの使用回数は超えていないかどうか
// ログインが必須である
class CouponUsageLimitPerUser implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        return !Order::where('user_id', auth()->user()->id)
            ->where('coupon_code', $value)
            ->whereIn('status', [OrderStatus::WAITING_SEND, OrderStatus::SENT, OrderStatus::COMPLETE])
            ->exists();
    }

    public function message()
    {
        return 'このクーポンは1回までの使用になります。';
    }
}
