<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrialProductSubItem extends BaseModel
{
    use SoftDeletes;

    protected $table = 'trialproduct_subproduct';
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];

    // 商品
    public function getSubItemFromId($id)
    {
        return $this->where('trial_product_id','=', $id)->get();
    }
}
