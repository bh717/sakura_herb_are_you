<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends BaseModel
{
    use SoftDeletes;

    protected $table = 'coupons';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
    ];
    protected $dates = [
        'expired_at',
    ];
    protected $casts = [];

    public function getExpiredAtAttribute(): ?string
    {
        if (is_null($this->attributes["expired_at"])) {
            return null;
        }
        return $this->asDateTime($this->attributes["expired_at"])->format('Y-m-d H:i:s');
    }

    public static function canUseCoupon(int $totalPrice): bool
    {
        return $totalPrice >= config('order.coupon_usable_amount');
    }
}
