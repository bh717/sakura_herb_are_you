<?php

namespace App\Models;

use App\Enums\ProductRecommendationKind;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductRecommendation extends BaseModel
{
    use SoftDeletes;

    public const KIND = ProductRecommendationKind::class;

    protected $table = 'product_recommendations';
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
