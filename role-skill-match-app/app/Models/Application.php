<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;
    // links to factory for seeding
    use HasFactory;

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

    protected $primaryKey = 'application_id';

    protected $fillable = [
        'is_selected',
        'application_date',

    ];
}
