<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\JsonResource;

class UploadFileResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        $data = parent::toArray($request);
        $data['url'] = config('aws.cloudfront_domain') . $this->file_path;
        return $data;
    }
}
