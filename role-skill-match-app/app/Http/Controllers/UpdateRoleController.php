<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Role_Listing;
Use App\Models\Role;
Use App\Models\Hiring_Manager;
Use App\Models\Staff;
Use App\Models\Application;
Use App\Models\Department;
Use App\Models\Role_Skill;
Use App\Models\Skill;
use Illuminate\Support\Facades\DB;

/*
$request = new Request();
            // Set the input data
            $request->merge([
                '_token' => 'IgfOyMbAdJXvrQGRkagnbpex41WrY8h7ZR3S1Kzu',
                'listing_id' => '3',
                'jobTitle' => 'UpdatedTitle',
                'workArrangement' => 'Full Time',
                'department' => '3',
                'hiringManager' => ['Kim Sejeong'],
                'vacancy' => '5',
                'deadline' => '2023-12-31',
                'description' => 'Lorem ipsum dolor sit amet'
            ]);
*/      
           

class UpdateRoleController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        dd($request->input());
        return($request->input());
    }

    public function autoFillRoleListing($passedlisting=1)   
    {
        // Retrieve all role data from the database
        $RoleListing_Table = Role_Listing::where('role_id', $passedlisting)->get(); 
        //declaring tables
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','role']);
        $HiringManager_Table = Hiring_Manager::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','staff_id']);
        $Department_Table = Department::whereIn('department_id', $RoleListing_Table->pluck('department_id'))->get(['department_id','department']);
        $Role_Table = Role::whereIn('role_id', $RoleListing_Table->pluck('role_id'))->get(['role_id','role']);
        //$RoleSkill_Table = Role_Skill::where('listing_id', $passedlisting)->get(['listing_id','skill_id']);
        $RoleSkill_Table = Role_Skill::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))->get(['listing_id','skill_id']);
          
        $Skill_Table = Skill::join('role_skill', 'skill.skill_id', '=', 'role_skill.skill_id')
            ->join('role_listing', function ($join) use ($passedlisting) {
                $join->on('role_skill.listing_id', '=', 'role_listing.listing_id')
                    ->where('role_listing.listing_id', '=', $passedlisting);
            })
            ->select('skill.skill')
            ->get();

        $roles = $RoleListing_Table->map(function ($role) use ($Skill_Table,$Role_Table,$HiringManager_Table,$RoleListing_Table,$Department_Table,$passedlisting,$RoleSkill_Table) {
        $staffNames = [];
        $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);
        $workArrangement = $RoleListing_Table->first()->work_arrangement;  
        $vacancy= $RoleListing_Table->first()->vacancy; 
        $deadline= $RoleListing_Table->first()->deadline; 
        $department = $Department_Table->first()->department;
        $department_id =$Department_Table->first()->department_id;
        $description = $RoleListing_Table->first()->description; 
        $skills = $Skill_Table->pluck('skill')->toArray();
    
        $isFirstIteration = true; 
        

        $staffNames = DB::table('role_listing')
            ->where('listing_id', $passedlisting)
            ->join('hiring_manager', 'role_listing.role_id', '=', 'hiring_manager.role_id')
            ->join('staff', 'hiring_manager.staff_id', '=', 'staff.staff_id')
            ->selectRaw('DISTINCT CONCAT(staff.staff_lname, " ", staff.staff_fname) as staff_name')
            ->pluck('staff_name')
            ->toArray();
            
        
        // Find the corresponding staff record using the role_id
       
        $status = $role->status === 1 ? 'Open' : 'Closed';
        
            return [
                //'role_id' => $matchingRole ? $matchingRole->role_id : null,
                'role' => $matchingRole ? $matchingRole->role : null,  //job title
                'work_arrangement' => $workArrangement, //work arrangement
                'department'=>$department,   //department
                'department_id'=>$department_id,
                'vacancy' => $vacancy, //vacancy
                'deadline' => $deadline, //deadline
                'staff_name' => $staffNames,
                'description'=>$description,
                'skills'=>$skills
            ];
        });

        return response()->json($roles);
    }
        /*
        [{"_token":"IgfOyMbAdJXvrQGRkagnbpex41WrY8h7ZR3S1Kzu",
            "listing_id": "3"
            "jobTitle":"UpdatedTitle",
            "workArrangement":"Full Time",
            "department": "1",
            "hiringManager":["Kim Sejeong"],
            "vacancy":"5",
            "deadline":"2023-12-31",
            "description":"Lorem ipsum dolor sit amet"}]
            */
            
        public function updateRoleListing(Request $request)
        {

            dd($request->input());
            return($request->input());
            //$requestData = $request->input()[0]; // Assuming the input is an array of one element
        
            $listingId = $requestData['listing_id'];
            $jobTitle = $requestData['jobTitle'];
            $workArrangement = $requestData['workArrangement'];
            $department = $requestData['department'];
            $hiringManagers = $requestData['hiringManager'];
            $vacancy = $requestData['vacancy'];
            $deadline = $requestData['deadline'];
            $description = $requestData['description'];
        
            // 1st field: Update "role" column in "role" table
            $role = Role_Listing::where('listing_id', $listingId)->first();
            if ($role) {
                $roleId = $role->role_id;
                Role::where('role_id', $roleId)->update(['role' => $jobTitle]);
            }
        
            // 2nd field: Update "work_arrangement" in role_listing table
            $workArrangementText = $workArrangement == "1" ? "Full Time" : "Part Time";
            Role_Listing::where('listing_id', $listingId)->update(['work_arrangement' => $workArrangementText]);
        
            // 3rd field: Update "department" column in department table
            $departmentId = Role_Listing::where('listing_id', $listingId)->value('department_id');
            Department::where('department_id', $departmentId)->update(['department' => $department]);
        
            // 4th field: Update or create hiring_manager records
            $roleIds = Role_Listing::where('listing_id', $listingId)->pluck('role_id')->toArray();
            foreach ($hiringManagers as $hiringManager) {
                $staff = Staff::whereRaw("CONCAT(staff_lname, ' ', staff_fname) = ?", $hiringManager)->first();
                if ($staff) {
                    $staffId = $staff->staff_id;
                    foreach ($roleIds as $roleId) {
                        $existingRecord = Hiring_Manager::where('staff_id', $staffId)->where('role_id', $roleId)->first();
                        if ($existingRecord) {
                            $existingRecord->update(['staff_id' => $staffId]);
                        } else {
                            Hiring_Manager::create(['staff_id' => $staffId, 'role_id' => $roleId]);
                        }
                    }
                }
            }
        
            // 5th field: Update "vacancy" in role_listing table
            Role_Listing::where('listing_id', $listingId)->update(['vacancy' => $vacancy]);
        
            // 6th field: Update "deadline" in role_listing table
            Role_Listing::where('listing_id', $listingId)->update(['deadline' => $deadline]);
        
            // 7th field: Update "description" in role_listing table
            Role_Listing::where('listing_id', $listingId)->update(['description' => $description]);
        
            return response()->json(['message' => 'Fields updated successfully']);
        }

        public function retrieveAllDepartments()
        {
            $departmentTable = Department::all(); // Assuming $Department_Table contains the records

            $departments = $departmentTable->pluck('department'); // Extract 'department' column values

            return response()->json($departments);
        }
}
?>

