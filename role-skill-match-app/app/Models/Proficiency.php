<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proficiency extends Model
{
    // One-to-many relationship with `Staff_Skill` model
    public function staff(): HasMany
    {
        return $this->hasMany(Staff_Skill::class, 'proficiency_id');
    }
}