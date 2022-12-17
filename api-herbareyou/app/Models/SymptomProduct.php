<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SymptomProduct extends BaseModel
{
    use SoftDeletes;

    protected $table = 'products';
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];

    // 商品
    public function getIdFromProduct($id)
    {
        $data['product_data'] = $this->where('product_no', '=', $id)->get();
        $data['upload_files'] = $this->join('product_upload_file', 'products.id', '=', 'product_upload_file.product_id')->join('upload_files', 'product_upload_file.upload_file_id', '=', 'upload_files.id')->where('product_no', '=', $id)->pluck('upload_files.file_path')->toArray();
        $data['tastes'] = $this->join('product_taste', 'products.id', '=', 'product_taste.product_id')->join('tastes', 'product_taste.taste_id', '=', 'tastes.id')->where('product_no', '=', $id)->pluck('tastes.name')->toArray();
        $data['materials'] = $this->join('product_material', 'products.id', '=', 'product_material.product_id')->join('materials', 'product_material.material_id', '=', 'materials.id')->where('product_no', '=', $id)->pluck('materials.name')->toArray();
        $data['keywords'] = $this->join('product_keywords', 'products.id', '=', 'product_keywords.id')->where('product_no', '=', $id)->pluck('product_keywords.keyword')->toArray();
        return $data;
    }
}
