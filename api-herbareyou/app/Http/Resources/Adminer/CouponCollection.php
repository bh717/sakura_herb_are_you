<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CouponCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {
        return CouponResource::collection($this->collection);
    }
}
