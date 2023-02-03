<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrialProductCategory extends BaseModel
{
    use SoftDeletes;

    protected $table = 'trialproduct_categories';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];

    // 商品
    public function trialproducts(): HasMany
    {
        return $this->hasMany('App\Models\TrialProduct', 'product_id');
    }
}
