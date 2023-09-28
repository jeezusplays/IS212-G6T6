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
Use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


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
    { // MNEED TO RETRIEVE COUNTRY
        // Retrieve all role data from the database
        $RoleListing_Table = Role_Listing::where('listing_id', $passedlisting)->get(); 
        //declaring tables
        $HiringManager_Table = Hiring_Manager::whereIn('listing_id', $RoleListing_Table->pluck('listing_id'))->get(['listing_id','staff_id']);
        
        $Department_Table = Department::whereIn('department_id', $RoleListing_Table->pluck('department_id'))->get(['department_id','department']);

        $Country_Table = Country::whereIn('country_id', $RoleListing_Table->pluck('country_id'))->get(['country_id','country']);

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

        $roles = $RoleListing_Table->map(function ($role) use ($Skill_Table,$Role_Table,$HiringManager_Table,$RoleListing_Table,$Department_Table,$passedlisting,$RoleSkill_Table,$Country_Table) {
        $staffNames = [];
        $matchingRole = $Role_Table->firstWhere('role_id', $role->role_id);
        $workArrangement = $RoleListing_Table->first()->work_arrangement;  
        $vacancy= $RoleListing_Table->first()->vacancy; 
        $deadline= $RoleListing_Table->first()->deadline; 
        $department = $Department_Table->first()->department;
        $department_id =$Department_Table->first()->department_id;
        $country = $Country_Table->first()->country;
        $country_id = $Country_Table->first()->country_id;
        $description = $RoleListing_Table->first()->description; 
        $skills = $Skill_Table->pluck('skill')->toArray();
        $status= $RoleListing_Table->first()->status; 

        //$country_id= $RoleListing_Table->first()->country_id;
       

        $isFirstIteration = true; 
        
        $staffNames = DB::table('role_listing')
            ->where('hiring_manager.listing_id', $passedlisting)
            ->join('hiring_manager', 'role_listing.listing_id', '=', 'hiring_manager.listing_id')
            ->join('staff', 'hiring_manager.staff_id', '=', 'staff.staff_id')
            ->selectRaw('DISTINCT CONCAT(staff.staff_lname, " ", staff.staff_fname) as staff_name')
            ->pluck('staff_name')
            ->toArray();
            
        
        // Find the corresponding staff record using the role_id
       
        //$status = $role->status === 1 ? 'Open' : 'Closed';
        
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
                'skills'=>$skills,
                'status'=>$status,
                'country_id'=>$country_id,
                'country'=>$country,
                /* 'country_id' => $country_Id,
                'country' => $country, */

            ];
        });

        return response()->json($roles);
    }
        /*
        [{"_token":"IgfOyMbAdJXvrQGRkagnbpex41WrY8h7ZR3S1Kzu",
            "listing_id": "13"
            "jobTitle":"UpdatedTitle",
            "workArrangement":"1",
            "department": "1",
            "hiringManager":[6],
            "vacancy":"5",
            "deadline":"2023-12-31",
            "description":"Lorem ipsum dolor sit amet",
            "skills": [1,2] }]  
            */
        

    public function updateRoleListing(Request $request)
    {
            $requestData = $request->input();
            // hard coding the data for testing purposes
            $requestData["listing_id"] = "1";
            $requestData["jobTitle"] = "Financial Analyst";
            $requestData["workArrangement"] = 1;
            $requestData["department"] = "1";
            $requestData["hiringManager"] = [6];
            $requestData["vacancy"] = 6;
            $requestData["deadline"] = "2023-12-31";
            $requestData["description"] = "Lorem ipsum dolor sit amet";
            $requestData["skills"] = [1,2];  //amended skills 
            //actual start of code
            $listingId = $requestData['listing_id'];
            $jobTitle = $requestData['jobTitle'];
            $workArrangement = $requestData['workArrangement'];
            $department = $requestData['department'];
            $hiringManagers = $requestData['hiringManager'];
            $vacancy = $requestData['vacancy'];
            $deadline = $requestData['deadline'];
            $description = $requestData['description'];

            if (!is_array($requestData['skills'])) {
                $requestData['skills'] = [$requestData['skills']];
            }

            $skills = $requestData['skills'];

            if (!is_array($requestData['hiringManager'])) {
                $requestData['hiringManager'] = [$requestData['hiringManager']];
            }

            $hiringManagers = $requestData['hiringManager'];
            
            //get application
            $applicationsToDelete = DB::table('application')
                ->where('listing_id', $listingId)
                ->get();

            // Store the retrieved application records
            $storedApplications = $applicationsToDelete->toArray();
            // Soft delete records
            DB::table('hiring_manager')->where('listing_id', $listingId)->delete();
            DB::table('role_skill')->where('listing_id', $listingId)->delete();
            DB::table('application')->where('listing_id', $listingId)->delete();

            // Check if job title exists, get role_id
            $role = DB::table('role')
                ->where('role', $jobTitle)
                ->first();

            if (!$role) {
                return response()->json(['error' => 'Job title does not exist'], 400);
            }

            // Get department_id
            $dept = DB::table('department')
                ->where('department_id', $department)
                ->value('department_id');

            if (!$dept) {
                return response()->json(['error' => 'Department does not exist'], 400);
            }

            // Create record for each manager
            foreach ($hiringManagers as $manager) {
                DB::table('hiring_manager')->insert([
                    'listing_id' => $listingId,
                    'staff_id' => $manager,
                ]);
            }

            // Create skills for each listing
            foreach ($skills as $skill) {
                DB::table('role_skill')->insert([
                    'listing_id' => $listingId,
                    'skill_id' => $skill,
                ]);
            }

            // Get remaining info
            $roleListingData = DB::table('role_listing')
                ->select('country_id', 'created_at', 'created_by', 'status')
                ->where('listing_id', $listingId)
                ->first();

            $country_id = $roleListingData->country_id;
            $created_at = $roleListingData->created_at;
            $created_by = $roleListingData->created_by;
            $status = $roleListingData->status;

            // Soft delete the record in role_listing
            DB::table('role_listing')->where('listing_id', $listingId)->update(['deleted_at' => now()]);

            // Insert it back with soft delete
            $roleId = $role ? $role->role_id : null;

            Role_Listing::updateOrInsert(
                ['Listing_ID' => $listingId],
                [
                    'Role_ID' => $roleId,
                    'Description' => $description,
                    'Department_ID' => $dept,
                    'Country_ID' => $country_id,
                    'Work_Arrangement' => $workArrangement,
                    'Vacancy' => $vacancy,
                    'Status' => $status,
                    'Deadline' => $deadline,
                    'created_at' => $created_at,
                    'created_by' => $created_by,
                    'deleted_at' => null, // Set the deleted_at column to null for soft delete
                ]
            );
            foreach ($storedApplications as $storedApplication) {
                DB::table('application')->insert((array)$storedApplication);
            }

            return response()->json(['message' => 'Fields updated successfully']);
    }

            public function retrieveAllDepartments()
            {
                $departments = Department::all(['department_id', 'department']);

                return response()->json($departments);
            }

            public function retrieveAllHiringManagers()
            {
                $hiringManagers = Staff::whereIn('staff_id', function ($query) {
                        $query->select('staff_id')
                            ->from('Hiring_Manager');
                    })
                    ->selectRaw("staff_id, CONCAT(staff_lname, ' ', staff_fname) as hiring_manager_name")
                    ->get();

                return response()->json($hiringManagers);
            }


            public function retrieveAllSkills()
            {
                $skills = Skill::all(['skill_id', 'skill']);

                return response()->json($skills);
            }

            public function retrieveAllStatus()
            {
                $status = Role_Listing::all('status')->unique();

                return response()->json($status);
            }

            public function retrieveAllCountries()
            {
                $country = Country::all(['country_id', 'country']);

                return response()->json($country);
            }
}
?>

