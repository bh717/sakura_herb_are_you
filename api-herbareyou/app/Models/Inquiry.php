<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends BaseModel
{
    use SoftDeletes;

    protected $table = 'inquiries';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [];
}
