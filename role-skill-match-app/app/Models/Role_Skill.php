<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role_Skill extends Model
{
    // Many-to-one relationship with the `Role` Model
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_skill', 'role_id', 'skill_id'); // TODO: Check
    }

    // Many-to-one relationship with the `Skill` Model
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'role_skill', 'role_id', 'skill_id'); // TODO: Check
    }

}