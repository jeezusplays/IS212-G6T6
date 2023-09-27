<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hiring_Manager extends Model
{
    use SoftDeletes;
    // links to factory for seeding
    use HasFactory;

    // Many-to-one relationship with `Staff` Model
    public function role_manager_staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // Many-to-one relationship with `Role` Model
    protected $table = 'Hiring_Manager';

    public function access(): BelongsTo
    {
        return $this->belongsTo(Role_Listing::class, 'role_id');
    }

    protected $primaryKey = ['listing_id', 'staff_id'];
}
