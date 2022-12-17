<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends BaseModel
{
    use SoftDeletes;

    protected $table = 'faqs';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [];

    // カテゴリ
    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Models\FaqCategory', 'faq_category_id');
    }
}
