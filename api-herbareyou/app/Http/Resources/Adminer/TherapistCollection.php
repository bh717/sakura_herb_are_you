<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TherapistCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {
        return TherapistResource::collection($this->collection);
    }
}
