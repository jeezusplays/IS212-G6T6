<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_Listing extends Model
{
    // links to factory for seeding
    use HasFactory;
    use SoftDeletes;

    // Many-to-one relationship with `Department` Model
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    // Many-to-one relationship with `Country` Model
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // Many-to-one relationship with `Staff` Model (Created_By)
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // Many-to-many relationship with `Skill` Model through `Role_Skill` Model
    // public function skills(): BelongsToMany
    // {
    //     return $this->belongsToMany(Skill::class, 'role_skill', 'role_id', 'skill_id');
    // }

    // One-to-many relationship with `Role_Skill` Model
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'role_skill', 'listing_id', 'skill_id');
    }

    // Many-to-many relationship with `Application` Model
    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class, 'application_role', 'listing_id', 'application_id');
    }

    // Many-to-many relationship with `Hiring_Manager` Model
    public function managers(): BelongsToMany
    {
        return $this->belongsToMany(Hiring_Manager::class, 'hiring_manager', 'listing_id', 'staff_id');
    }

    protected $table = 'Role_Listing';

    protected $primaryKey = 'listing_id';

    protected $fillable = [
        'role_id',
        'description',
        'department_id',
        'country_id',
        'work_arrangement',
        'vacancy',
        'status',
        'deadline',
        'created_by',
    ];
}
