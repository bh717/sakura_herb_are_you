<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailedTaste extends BaseModel
{
    use SoftDeletes;

    protected $table = 'detailed_taste';
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];

    // 商品
    public function getNameFromId($id)
    {
        return $this->join('tastes', 'detailed_taste.taste_id', '=', 'tastes.id')->where('symptom_id', '=', $id)->get();
    }
}
