<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserResetPassword extends BaseAuthenticatableModel
{
    use SoftDeletes;

    protected $table = 'user_reset_passwords';
    protected $guarded = [
        'deleted_at'
    ];
    protected $hidden = [
    ];
    protected $casts = [
        'expired_at' => 'datetime:Y-m-d H:i:s',];
}
