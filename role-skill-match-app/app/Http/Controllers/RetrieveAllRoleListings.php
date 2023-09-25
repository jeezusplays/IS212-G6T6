<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
Use App\Models\Role_Listing;

class RetrieveAllRoleListings extends Controller
{
    public function role_listings()
    {
        return Role_Listing::all();
    }
}
