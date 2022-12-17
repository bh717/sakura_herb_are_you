<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends BaseModel
{
    use SoftDeletes;

    protected $table = 'faq_categories';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [];

    //
    public function faqs(): HasMany
    {
        return $this->hasMany('App\Models\Faq');
    }
}
