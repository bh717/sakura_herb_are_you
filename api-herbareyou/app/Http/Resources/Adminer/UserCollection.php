<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {
        return UserResource::collection($this->collection);
    }
}
