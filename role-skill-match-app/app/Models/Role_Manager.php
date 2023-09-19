<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_Manager extends Model
{
    use SoftDeletes;
    // links to factory for seeding
    use HasFactory;

    // Many-to-one relationship with `Staff` Model
    public function role_manager_staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // Many-to-one relationship with `Role` Model
    public function access(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    protected $primaryKey = ['role_id', 'staff_id'];
}
