<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_Skill extends Model
{
    use SoftDeletes;
    // links to factory for seeding
    use HasFactory;

    // Many-to-one relationship with the `Role` Model
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_skill', 'listing_id', 'skill_id'); // TODO: Check
    }

    // Many-to-one relationship with the `Skill` Model
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'role_skill', 'listing_id', 'skill_id'); // TODO: Check
    }

    protected $primaryKey = ['role_id', 'skill_id'];
}
