<?php

namespace App\Http\Resources\Adminer;

use App\Enums\OrderStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        $data = parent::toArray($request);
        $data['status_text'] = __('enums')[OrderStatus::class][$data['status']];
        return $data;
    }
}
