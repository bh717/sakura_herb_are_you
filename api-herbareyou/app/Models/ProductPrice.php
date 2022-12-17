<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends BaseModel
{
    use SoftDeletes;

    protected $table = 'product_prices';
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

    // 内消費税を返す
    public function getIncludeTaxAttribute(): ?string
    {
        return floor($this->price * (1 - (1 / (1 + config('order.product_tax_rate')))));
    }

    public static function getMinPracticeId(): array
    {
        $productPractices = DB::select("
            SELECT
                *
            FROM
                product_prices p1
            WHERE
                price =(
                    SELECT
                        min(p2.price)
                    FROM
                        product_prices p2
                    WHERE
                        p1.product_id = p2.product_id
                        and p1.deleted_at is null
                )
        ");
        if (count($productPractices) === 0) {
            return [];
        }
        $arrayData = [];
        foreach ($productPractices as $productPractice) {
            $arrayData[] = (array) $productPractice;
        }
        return $arrayData;
    }
}
