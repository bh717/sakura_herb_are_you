<?php

namespace App\Models;

use App\Enums\ContentKind;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends BaseModel
{
    use SoftDeletes;

    public const KIND = ContentKind::class;

    protected $table = 'contents';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [];
}
