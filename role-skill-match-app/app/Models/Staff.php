<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;
    // links to factory for seeding
    use HasFactory;

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

    // Many-to-one relationship with `AccessRight` model
    public function access(): BelongsTo
    {
        return $this->belongsTo(AccessRight::class, 'access_id');
    }

    // TODO: Check everything below this line ------------------------------------------------

    // One-to-many relationship with `Staff_Skill` model
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Staff_Skill::class, 'staff_skill', 'staff_id', 'skill_id');
    }

    // One-to-many relationship with `Application` model
    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class, 'application_role', 'staff_id', 'application_id');
    }

    // One-to-many relationship with `Role_Manager` model
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(Role_Manager::class, 'role_manager', 'staff_id', 'role_id');
    }

  
    protected $primaryKey = 'staff_id';

    protected $fillable = [
        'staff_fname',
        'staff_lname',
        'email'
    ];

}
