<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    // links to factory for seeding
    use HasFactory;
    use SoftDeletes;

    // Many-to-one relationship with `Staff` model
    public function staff_application(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // One to many relationship with "Role_Listing" model
    public function application_listing(): BelongsToMany
    {
        return $this->belongsToMany(Role_Listing::class, 'listing_id');
    }

    protected $table = 'Application';

    protected $primaryKey = 'application_id';

    protected $fillable = [
        'listing_id',
        'staff_id',
        'status',
        'application_date',
    ];
}
