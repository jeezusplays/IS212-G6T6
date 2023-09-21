<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleCreationController extends Controller
{
    public function store(){
        
        dump(request());
        return 'Hello World';
    }
}
