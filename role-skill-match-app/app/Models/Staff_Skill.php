<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff_Skill extends Model
{
    // links to factory for seeding
    use HasFactory;
    use SoftDeletes;

    // Many-to-one relationship with `Staff` model
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // Many-to-one relationship with `Skill` model
    public function skills(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    // Many-to-one relationship with `Proficiency` model
    public function proficiency(): BelongsTo
    {
        return $this->belongsTo(Proficiency::class, 'proficiency_id');
    }

    protected $table = 'Staff_Skill';

    protected $primaryKey = ['staff_id', 'skill_id'];
}
