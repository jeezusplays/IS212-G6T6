<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Role</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />

    <style>
        #grey-box{
            background-color: rgb(223, 231, 242);
        }

        .skill{
            background-color: rgb(223, 231, 242);
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 16px;
        }
    </style>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon-32x32.png') }}">
  </head>

  <body>

    <div class="container" id="app">

    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="http://localhost:8000/role-listings">
                <img src="{{ asset('favicon-32x32.png') }}" alt="Company Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="http://localhost:8000/role-listings">View Role Listings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost:8000/create-role">Create Role Listing</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/update-role">Edit Role Listing</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Staff Name (HR Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings">HR Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-staff">Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-manager">Manager</a></li>
                </ul>
            </div>
        </nav>
    </div>
        
    <div class="container-sm">
        <!-- @if ($isRoleValid)
            @foreach ($roles as $role) -->
            <div class="row mt-5 mb-4">
                <div class="col-12 col-sm-8 text-start">
                    <!-- <h1>{{$role['role']}}</h1> -->
                    <h1>Financial Analyst</h1>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="d-flex justify-content-start justify-content-sm-end">
                        <button type="submit" id="submit" type="button" class="btn btn-success btn-md btn-lg">Apply Now</button>
                    </div>
                </div>
            </div>
            
            <div class="row p-3 gy-2 gy-sm-0" id="grey-box">
                <!-- <div class="col-12 col-sm-4">
                    <b>Department</b> {{$role['department']}}
                </div> -->
                <div class="col-12 col-sm-4">
                    <b>Department</b> Finance
                </div>
                <div class="col-12 col-sm-4">
                    <b>Work Arrangement</b> 
                    <!-- @if ($role['work_arrangement'] == 1)
                    Full Time
                    @else 
                    Part Time
                    @endif -->
                    Full Time
                </div>
                <div class="col-12 col-sm-4">
                    <!-- <b>Country</b> {{$role['country']}} -->
                    <b>Country</b> Singapore
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <h3>Job Description</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <!-- {{$role['description']}} -->
                    Test Description
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <h3>Skills</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <!-- @foreach ($role['skills'] as $skill) -->
                        <button class="skill">Capital Management</button>
                    <!-- @endforeach -->
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col">
                    <h3>Vacancy</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <!-- {{$role['vacancy']}} positions -->
                    1 positions
                </div>
            </div>

            <div class="row mt-5">
                <div class="col text-danger">
                    <!-- This listing closes on {{$role['deadline']}} -->
                    This listing closes on 2021-10-31
                </div>
            </div>
            <!-- @endforeach -->
        <!-- @else -->
            <!-- <div class="alert alert-danger">
                Invalid Role
            </div> -->
        <!-- @endif -->
    </div>

        <!-- Bootstrap Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    
    <!-- JS SCRIPTS TO TRIGGER THE ALERTS -->
    <script>
        // Trigger alerts
        $("#submit").click(function() {
            var roleSkillMatch = $role['skills']; // undersand that you will be hardcoding this
            var numOngoingApplications = <? count($existing_applications) ?>;
            var vacancy = <? $listing->vacancy ?>;
            var currRoleId = <? $staff_role ?>;
            var listId = <? $listing->role_id ?>;


        // Check if there are 5 ongoing applications
        if (numOngoingApplications >= 5) {
          swal({
            title: "Application Failed",
            text: "You cannot have more than 5 ongoing applications",
            icon: "error",
            button: "Back",
          });
        }

        // Check if there is a skill match
        else if (roleSkillMatch == 0){
          swal({
            title: "Application Failed",
            text: "You do not have the required skills for this role",
            icon: "error",
            button: "Back",
            });
        }

        // Check if it is the same role
        else if (currRoleId == listId){
            swal({
                title: "Application Failed",
                text: "You already have this role",
                icon: "error",
                button: "Back",
                });
            }

        // Check if role is closed
        else if (vacancy == 0){
          swal({
            title: "Application Failed",
            text: "This role has no vacancies",
            icon: "error",
            button: "Back",
            });
        }
        else if (currRoleId == listId){
            swal({
                title: "Application Failed",
                text: "You already have this role",
                icon: "error",
                button: "Back",
                });
            }
        
        else {
          swal({
            title: "Application Submitted",
            text: "You have successfully applied for this role",
            icon: "success",
            button: "Got it!",
          });
        }

      });

    </script>

    </body>
</html>
