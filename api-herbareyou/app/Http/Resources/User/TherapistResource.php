<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class TherapistResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        $data = parent::toArray($request);
        if (isset($data['upload_files'][0])) {
            $data['upload_files'][0]['url'] = isset($this->uploadFiles[0]->file_path)
                ? config('aws.cloudfront_domain') . $this->uploadFiles[0]->file_path
                : config('consts.no_image_url');
        } else {
            $data['upload_files'] = [
                [
                    'url' => config('consts.no_image_url')
                ],
            ];
        }
        return $data;
    }
}
