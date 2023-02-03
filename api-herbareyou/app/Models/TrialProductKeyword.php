<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrialProductKeyword extends BaseModel
{
    use SoftDeletes;

    protected $table = 'trialproduct_keywords';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];

    // 商品
    public function trialproduct(): BelongsTo
    {
        return $this->belongsTo('App\Models\TrialProduct', 'trial_product_id');
    }
}
