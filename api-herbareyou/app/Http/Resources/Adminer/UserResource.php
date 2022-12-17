<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'last_name_kana' => $this->last_name_kana,
            'first_name_kana' => $this->first_name_kana,
            'birthday' => $this->birthday,
            'zip' => $this->zip,
            'address1' => $this->address1,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
