<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    // links to factory for seeding
    use HasFactory;
    use SoftDeletes;

    // One-to-many relationship with the `Role_Skill` Model
    public function role_skill(): BelongsToMany
    {
        return $this->belongsToMany(Role_Skill::class, 'role_skill', 'skill_id', 'role_id');
    }

    // One-to-many relationship with the `Staff_Skill` Model
    public function staff_skill(): BelongsToMany
    {
        return $this->belongsToMany(Staff_Skill::class, 'staff_skill', 'skill_id', 'staff_id');
    }

    // Many-to-many relationship with the `Role` Model through the `Role_Skill` Model
    // public function role(): BelongsToMany
    // {
    //     return $this->belongsToMany(Role::class, 'role_skill', 'skill_id', 'role_id');
    // }

    // Many-to-many relationship with the `Staff` Model through the `Staff_Skill` Model
    public function staff(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class, 'staff_skill', 'skill_id', 'staff_id');
    }

    protected $table = 'Skill';

    protected $primaryKey = 'skill_id';

    protected $fillable = [
        'skill',
    ];
}
