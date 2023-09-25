<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    // links to factory for seeding
    use HasFactory, SoftDeletes;

    // One-to-many relationship with `Staff` model
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class, 'role_id');
    }

    // One-to-many relationship with `Role_Listing` model
    public function roleListings(): HasMany
    {
        return $this->hasMany(Role_Listing::class, 'role_id');
    }

    protected $table = 'Role';

    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role'
    ];
}