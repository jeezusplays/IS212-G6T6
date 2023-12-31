<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission_Rights extends Model
{
    // links to factory for seeding
    use HasFactory;

    use SoftDeletes;

    protected $table = 'Permission_Rights';

    // Many-to-one relationship with `Permission` Model
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    // Many-to-one relationship with `Access_Rights` Model
    public function access(): BelongsTo
    {
        return $this->belongsTo(Access_Rights::class, 'access_id');
    }
}
