<?php

namespace App\Models;

use App\Enums\IsPublic;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TherapistBlog extends BaseModel
{
    use SoftDeletes;

    public const IS_PUBLIC = IsPublic::class;

    protected $table = 'therapist_blogs';
    protected $guarded = [];
    protected $hidden = [
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];

    // セラピスト
    public function therapist(): BelongsTo
    {
        return $this->belongsTo('App\Models\Therapist');
    }

    // ファイル
    public function uploadFiles(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\UploadFile', 'therapist_blog_upload_file');
    }
}
