<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Proficiency extends Model
{
    use SoftDeletes;
    // links to factory for seeding
    use HasFactory;

    // One-to-many relationship with `Staff_Skill` model
    public function staff(): HasMany
    {
        return $this->hasMany(Staff_Skill::class, 'proficiency_id');
    }
    

    protected $primaryKey = 'proficiency_id';

    protected $fillable = [
        'proficiency'
    ];
}