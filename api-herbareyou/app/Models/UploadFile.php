<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UploadFile extends BaseModel
{
    use SoftDeletes;

    protected $table = 'upload_files';
    protected $guarded = [];
    protected $hidden = [
        // 'id',
        'upload_file_able_id',
        'upload_file_able_type',
        'remarks',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];

}
