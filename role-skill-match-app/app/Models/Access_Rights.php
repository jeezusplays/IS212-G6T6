<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Access_Rights extends Model
{
    // creates Deleted At column in database, does not delete record
    use SoftDeletes;
    // links to factory for seeding
    use HasFactory;

    // One-to-many relationship with `Permission_Rights` model
    public function rights(): HasMany
    {
        return $this->hasMany(Permission_Rights::class, 'access_id');
    }

    // One-to-many relationship with `Staff` model
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class, 'access_id');
    }
    // define primary key
    protected $table = 'Access_Rights';

    protected $primaryKey = 'access_id';

    // define fields for mass assignment using object relational mapping
    protected $fillable = [
        'access_name',
    ];
}
