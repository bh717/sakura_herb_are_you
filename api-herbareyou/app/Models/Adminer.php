<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class Adminer extends BaseAuthenticatableModel
{
    use Notifiable;
    use SoftDeletes;
    use HasMultiAuthApiTokens;

    protected $table = 'adminers';
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'remarks',
        'status',
    ];
    protected $casts = [];
}
