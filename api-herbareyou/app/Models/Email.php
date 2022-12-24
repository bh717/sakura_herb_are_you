<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends BaseModel
{
    use SoftDeletes;

    protected $table = 'users';
    protected $guarded = [];
    protected $hidden = [];
    protected $casts = [];

    // 商品
    public function getNamefromEmail($email)
    {
        return $this->where('email', '=', $email)->get();
    }
}
