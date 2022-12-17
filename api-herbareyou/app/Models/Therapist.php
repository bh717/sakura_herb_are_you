<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Therapist extends BaseModel
{
    use SoftDeletes;

    protected $table = 'therapists';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];

    // ブログ
    public function blogs(): HasMany
    {
        return $this->hasMany('App\Models\TherapistBlog');
    }
}
