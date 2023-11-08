<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    // links to factory for seeding
    use HasFactory;
    use SoftDeletes;

    // One-to-many relationship with `Staff` model
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class);
    }

    // One-to-many relationship with `Role` model
    public function roles(): HasMany
    {
        return $this->hasMany(Role_Listing::class);
    }

    protected $table = 'Department';

    protected $primaryKey = 'department_id';

    protected $fillable = [
        'department',
    ];
}
