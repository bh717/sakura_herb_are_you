<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailedSymptom extends BaseModel
{
    use SoftDeletes;

    protected $table = 'detailed_symptoms';
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];

    // 商品
    public function getNameFromId($id)
    {
        return $this->where('symptom_id', '=', $id)->get();
    }
}
