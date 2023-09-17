<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff_Skill extends Model
{
    // Many-to-one relationship with `Staff` model
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // Many-to-one relationship with `Skill` model
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    // Many-to-one relationship with `Proficiency` model
    public function proficiency(): BelongsTo
    {
        return $this->belongsTo(Proficiency::class, 'proficiency_id');
    }
}