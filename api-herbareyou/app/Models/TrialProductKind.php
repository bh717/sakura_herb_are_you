<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrialProductKind extends BaseModel
{
    use SoftDeletes;

    protected $table = 'trialproduct_recommendations';
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];

    // 商品
    public function getKindfromId($id)
    {
        return $this->where('trial_product_id','=', $id)->get();
    }
}
