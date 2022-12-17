<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taste extends BaseModel
{
    use SoftDeletes;

    protected $table = 'tastes';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];

    // 商品
    public function products(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Product', 'product_taste');
    }
}
