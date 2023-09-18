<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    // links to factory for seeding
    use HasFactory;
    // One-to-many relationship with `Permission_Rights` model
    public function rights(): HasMany
    {
        return $this->hasMany(Permission_Rights::class, 'permission_id');
    }

    protected $primaryKey = 'permission_id';

    protected $fillable = [
        'permission'
    ];
}