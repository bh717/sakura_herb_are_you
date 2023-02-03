<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TrialProductCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {
        if (get_class($this->resource) === 'Illuminate\Pagination\LengthAwarePaginator') {
            self::$wrap = 'data';
        }
        return TrialProductResource::collection($this->collection);
    }
}
