<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ContentCategory extends BaseModel
{
    use SoftDeletes;

    protected $table = 'contents';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [];
}
