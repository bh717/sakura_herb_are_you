<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'discount_price' => $this->discount_price,
            'expired_at' => $this->expired_at,
            'usage_limit_per_user' => $this->usage_limit_per_user,
        ];
    }
}
