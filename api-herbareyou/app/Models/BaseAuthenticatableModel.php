<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseAuthenticatableModel extends Authenticatable
{
    public function getCreatedAtAttribute(): ?string
    {
        if (is_null($this->attributes["created_at"])) {
            return null;
        }
        return $this->asDateTime($this->attributes["created_at"])->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute(): ?string
    {
        if (is_null($this->attributes["updated_at"])) {
            return null;
        }
        return $this->asDateTime($this->attributes["updated_at"])->format('Y-m-d H:i:s');
    }

    public function getDeletedAtAttribute(): ?string
    {
        if (is_null($this->attributes["deleted_at"])) {
            return null;
        }
        return $this->asDateTime($this->attributes["deleted_at"])->format('Y-m-d H:i:s');
    }
}
