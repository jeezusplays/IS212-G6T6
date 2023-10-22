<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    // links to factory for seeding
    use HasFactory;
    use SoftDeletes;

    // Many-to-one relationship with `Department` model
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // Many-to-one relationship with `Country` model
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // Many-to-one relationship with `Access_Rights` model
    public function access(): BelongsTo
    {
        return $this->belongsTo(Access_Rights::class, 'access_id');
    }

    // TODO: Check everything below this line ------------------------------------------------

    // One-to-many relationship with `Staff_Skill` model
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'staff_skill', 'staff_id', 'skill_id');
    }

    // One-to-many relationship with `Application` model
    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class, 'application_role', 'staff_id', 'application_id');
    }

    // One-to-many relationship with `Hiring_Manager` model
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(Hiring_Manager::class, 'hiring_manager', 'staff_id', 'role_id');
    }

    protected $table = 'Staff';

    protected $primaryKey = 'staff_id';

    protected $fillable = [
        'staff_fname',
        'staff_lname',
        'email',
    ];
}
