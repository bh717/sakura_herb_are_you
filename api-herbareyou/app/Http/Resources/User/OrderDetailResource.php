<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        $data = parent::toArray($request);
        $data['product'] = new ProductResource($this->product);
        return $data;
    }
}
