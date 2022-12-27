<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailedFlavor extends BaseModel
{
    use SoftDeletes;

    protected $table = 'detailed_flavor';
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];

    // 商品
    public function getNameFromId($id)
    {
        return $this->join('flavors', 'detailed_flavor.flavor_id', '=', 'flavors.id')->where('detailed_flavor.symptom_id', '=', $id)->get();
    }
}
