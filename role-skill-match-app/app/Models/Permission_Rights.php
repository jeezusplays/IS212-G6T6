<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission_Rights extends Model
{
    // Many-to-one relationship with `Permission` Model
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    // Many-to-one relationship with `Access_Rights` Model
    public function access(): BelongsTo
    {
        return $this->belongsTo(AccessRight::class, 'access_id');
    }
}