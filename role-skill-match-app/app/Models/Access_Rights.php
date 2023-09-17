<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Access_Rights extends Model
{
    // One-to-many relationship with `Permission_Rights` model
    public function rights(): HasMany
    {
        return $this->hasMany(Permission_Rights::class, 'access_id');
    }

    // One-to-many relationship with `Staff` model
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class, 'access_id');
    }
}