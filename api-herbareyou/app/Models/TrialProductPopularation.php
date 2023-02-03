<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TrialProductPopularation extends BaseModel
{
    protected $table = 'trialproduct_popularations';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [];

    protected $appends = [
    ];

    // 購入された商品数に並び替えて取得
    public static function getOrderByBuyCount(): Collection
    {
        return OrderDetail::where(
            'created_at',
            '>',
            (new Carbon())->subDays(config('consts.POPULARATION_PERIOD_DAYS'))
        )
        ->selectRaw('count(trial_product_id) as count, trial_product_id')
        ->groupBy('trial_product_id')
        ->orderBy('count', 'desc')
        ->orderBy('trial_product_id')
        ->get();
    }
}
