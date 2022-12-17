<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public static $wrap = '';

    public function toArray($request)
    {
        if (get_class($this->resource) === 'Illuminate\Pagination\LengthAwarePaginator') {
            self::$wrap = 'data';
        }
        return ProductResource::collection($this->collection);
    }
}
