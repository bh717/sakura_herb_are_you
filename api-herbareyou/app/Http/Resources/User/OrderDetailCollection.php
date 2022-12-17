<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderDetailCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {
        return OrderDetailResource::collection($this->collection);
    }
}
