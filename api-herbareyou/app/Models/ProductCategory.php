<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends BaseModel
{
    use SoftDeletes;

    protected $table = 'product_categories';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];

    // 商品
    public function products(): HasMany
    {
        return $this->hasMany('App\Models\Product', 'product_id');
    }
}
