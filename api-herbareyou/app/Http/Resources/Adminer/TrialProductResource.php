<?php

namespace App\Http\Resources\Adminer;

use Illuminate\Http\Resources\Json\JsonResource;

class TrialProductResource extends JsonResource
{
    public static $wrap = '';

    public function toArray($request): array
    {
        $data = parent::toArray($request);
        $data['symptom_name_text_csv'] = $this->symptoms ? implode(',', $this->symptoms->pluck('name')->toArray()) : '';
        $data['taste_name_text_csv'] = $this->tastes ? implode(',', $this->tastes->pluck('name')->toArray()) : '';
        $data['material_name_text_csv'] = $this->materials ? implode(',', $this->materials->pluck('name')->toArray()) : '';
        $data['symptom_ids'] = $this->symptoms ? $this->symptoms->pluck('id')->toArray() : [];
        $data['taste_ids'] = $this->tastes ? $this->tastes->pluck('id')->toArray() : [];
        $data['flavor_ids'] = $this->flavors ? $this->flavors->pluck('id')->toArray() : [];

        $data['material_ids'] = $this->materials ? $this->materials->pluck('id')->toArray() : [];
        $data['keyword_csv'] =  $this->keywords ? implode(',', $this->keywords->pluck('keyword')->toArray()) : '';
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
