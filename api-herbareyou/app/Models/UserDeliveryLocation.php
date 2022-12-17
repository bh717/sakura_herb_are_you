<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserDeliveryLocation extends BaseModel
{
    use SoftDeletes;

    protected $table = 'user_delivery_locations';
    protected $guarded = [
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at',
    ];
    protected $casts = [];
}
