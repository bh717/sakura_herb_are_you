<?php

namespace App\Http\Resources\Adminer;

use App\Enums\IsPublic;
use Illuminate\Http\Resources\Json\JsonResource;

class TherapistResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        $data = parent::toArray($request);
        $data['is_public_text'] = __('enums')[IsPublic::class][$data['is_public']];
        
        $rows = count($data['upload_files']); 

        for($i=0; $i< $rows; $i++){
            if (isset($data['upload_files'][$i])) {
                $data['upload_files'][$i]['url'] = isset($this->uploadFiles[$i]->file_path)
                    ? config('aws.cloudfront_domain') . $this->uploadFiles[$i]->file_path
                    : config('consts.no_image_url');
            } else {
                $data['upload_files'] = [
                    [
                        'url' => config('consts.no_image_url')
                    ],
                ];
            }
        }
        return $data;
    }
}
