<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request): AnonymousResourceCollection
    {
        return OrderResource::collection($this->collection);
    }
}
