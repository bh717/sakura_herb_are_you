<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class User extends BaseAuthenticatableModel
{
    use Notifiable;
    use SoftDeletes;
    use HasMultiAuthApiTokens;

    protected $table = 'users';
    protected $guarded = [
        'deleted_at'
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'deleted_at',
    ];
    protected $casts = [    'is_mail_magazine' => 'boolean',
    ];

    public function deliveryLocation(): HasOne
    {
        return $this->hasOne(UserDeliveryLocation::class);
    }

    public function scopeWhereMailMagazine($query)
    {
        return $query->where('is_mail_magazine', true);
    }
}
