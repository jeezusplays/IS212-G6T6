<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{
    // One-to-many relationship with `Permission_Rights` model
    public function rights(): HasMany
    {
        return $this->hasMany(Permission_Rights::class, 'permission_id');
    }

}