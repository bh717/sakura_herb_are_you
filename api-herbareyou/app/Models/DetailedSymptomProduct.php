<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailedSymptomProduct extends BaseModel
{
    use SoftDeletes;

    protected $table = 'detailed_product';
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];

    // 商品
    public function getNameFromSymptom($name, $id)
    {
        return $this->where('detailed_symptom', '=', $name)->where('symptom_id','=', $id)->get();
    }
}
