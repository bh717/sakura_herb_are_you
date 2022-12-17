<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class OrderDetail extends BaseModel
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'order_details';
    protected $guarded = [
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [
    ];

    // 注文
    public function order(): BelongsTo
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    // 商品
    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    // 商品カテゴリ
    public function productCategory(): BelongsTo
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
    }

    // 商品値段
    public function productPrice(): BelongsTo
    {
        return $this->belongsTo('App\Models\ProductPrice', 'product_price_id');
    }
}
