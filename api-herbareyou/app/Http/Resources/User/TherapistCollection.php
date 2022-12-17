<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Adminer\TherapistResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TherapistCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {
        return TherapistResource::collection($this->collection);
    }
}
