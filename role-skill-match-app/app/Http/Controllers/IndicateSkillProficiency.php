<?php


namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Department;
use App\Models\Hiring_Manager;
use App\Models\Role;
use App\Models\Role_Listing;
use App\Models\Role_Skill;
use App\Models\Skill;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class IndicateSkillProficiency extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('/indicate-skill-proficiency', compact('roles'));
    }
}