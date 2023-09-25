<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateRoleController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        return($request->input());
    }
}
?>