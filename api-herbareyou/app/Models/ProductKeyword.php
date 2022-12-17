<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductKeyword extends BaseModel
{
    use SoftDeletes;

    protected $table = 'product_keywords';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];

    // 商品
    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
