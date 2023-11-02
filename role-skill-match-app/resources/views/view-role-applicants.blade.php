<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $roles[0]['role'] }} Applicants</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <style>
        #grey-box {
            background-color: rgb(223, 231, 242);
        }

        .skill {
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

<body onload = "start()">
    {{-- Top Menu Bar --}}
    <div id="app" class="container">
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
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- Retrieve default HR staff name [Park Bo Gum, Role id = 5] from database --}}
                    Park Bo Gum (HR Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings">HR Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/browse-roles">Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-management">Manager</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-sm" >
        @if ($isRoleValid)
            @foreach ($roles as $role)
                <div class="row mt-5 mb-4">
                    <div class="col-12 text-start">
                        <h1>Applicants for <i>{{ $role['role'] }} (
                        @if ($role['work_arrangement'] == 1)
                            Part Time
                        @else
                            Full Time
                        @endif
                        )
                        </i> role</h1>
                    </div>
                </div>

                <div class = "container" id ="grey-box">

                </div>
                <div class="row p-3 gy-2 gy-sm-0" id="grey-box">
                        <div class="col-12 col-sm-4">
                            <b>Department:</b> {{ $role['department'] }}
                        </div>

                        <div class="col-12 col-sm-4">
                            <b>Country:</b> {{ $role['country'] }}
                        </div>

                        <div class="col-12 col-sm-4">
                            <b>Vacancy: </b>{{ $role['vacancy'] }} 
                        </div>

                        <div class="row mt-3">
                            <div class="col text-danger">
                                This listing closes on {{ $role['deadline'] }}
                            </div>
                        </div>

                </div>
                
                <div class="mt-4">
                    <h4>Role Skills</h4>
                </div>

                <div class="row mt-2 mb-3">
                    <div class="col">
                        @foreach ($role['skills'] as $skill)
                            <button class="skill listing_skill">{{ $skill }}</button>
                        @endforeach
                    </div>
                </div>
                
                {{-- Search Bar --}}
                <div class="mb-3">
                    <form class="d-flex" id = "searchSubmit" onsubmit="searchApplicants(); return false;">
                        <input class="form-control me-2 form-control-lg" id="myInput" type="search" placeholder="Search by role title" aria-label="Search">
                        <button class="btn btn-success form-control-lg" id="searchButton" type="submit">
                            Search
                        </button>
                    </form>
                </div>


                {{-- Create a bootstrap table containing columns 'Name, 'Application Date', 'Skillset', 'Status', 'Email' --}}
                <div class="row mt-5">
                    <h4>Applicants</h4>
                    <div class="col">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class = "align-middle" style = "background-color: rgb(223, 231, 242);">
                                <tr>
                                    <th scope="col">Name</th>
                                    <!-- <th scope="col">Role</th> -->
                                    <th scope="col">Application Date</th>
                                    <th scope="col">Skillset & Proficiency</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Skillset Match %</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($role['applicants']) === 0)
                                    <tr>
                                        <td colspan="6" style="text-align: center;">There are no applicants for this role listing yet.
                                        </td>
                                    </tr>
                                @else
                                @foreach ($role['applicants'] as $applicant)
                                    <tr class ="applicant" >
                                        <td class="appName">{{ $applicant['staff_name'] }}</td>
                                        <td>{{ $applicant['application_date'] }}</td>
                                        <td>

                                            {{-- Iterate through both $applicant['skillset'] and $applicant['proficiency'] together at same index --}}
                                            @foreach ($applicant['skillset'] as $index => $skill)
                                                <button class="skill app_skill" style ="text-align: left; padding: 5px 10px;">{{ $skill }}
                                                    ({{ $applicant['proficiency'][$index] }})</button>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{-- Status: 1 = Applied, 2 = HR Received, 3 = Interview scheduled, 
                                                4 = accept , 5 = rejected, 6 = withdrawn
                                            --}}
                                            @if ($applicant['status'] == 1)
                                                Applied
                                            @elseif ($applicant['status'] == 2)
                                                HR Received
                                            @elseif ($applicant['status'] == 3)
                                                Interview scheduled
                                            @elseif ($applicant['status'] == 4)
                                                Accepted
                                            @elseif ($applicant['status'] == 5)
                                                Rejected
                                            @elseif ($applicant['status'] == 6)
                                                Withdrawn
                                            @endif
                                        </td>
                                        {{-- create a td with hyperlinked field --}}
                                        <td><a href="mailto:{{ $applicant['email'] }}">{{ $applicant['email'] }}</a>
                                        </td>
                                        <td><span class="role-skill-match-percent" style="color: darkgreen;">10%</span></td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
            @endforeach
        @else
            <div class="alert alert-danger">
                Notice: Role has been closed! 
                Please reopen the role listing to view role applicants.
            </div>
        @endif
    </div>

</body>

<script>
    function start(){
        searchApplicants()
        progressColorChange()
    }

    function searchApplicants(){
        const input = document.getElementById('myInput').value.toLowerCase().trim()

        document.querySelectorAll('.applicant').forEach(applicant => {
            let matchCount = 0;

            //name search func
            let name = applicant.querySelector('.appName').innerHTML.toLowerCase()
            if (name.indexOf(input) > -1 ){
                matchCount +=1
            }

            //skill search func
            let skills = applicant.querySelectorAll('.app_skill')
            skills.forEach(item => {
                skill = item.innerHTML.toLowerCase().split('(')[0].trim()
                if (skill.indexOf(input) > -1){
                    matchCount +=1
                }  
            })

            if (input == ''){
                applicant.style.visibility = "visible";
            }
            else if (matchCount == 0){
                applicant.style.visibility = "collapse";
            }
            else{
                applicant.style.visibility = "visible";
            }
        })
    }

    function progressColorChange(){
        
        let listing_skills = document.querySelectorAll('.listing_skill')
        let skill_len = listing_skills.length;
        console.log(skill_len);

        document.querySelectorAll('.applicant').forEach(applicant => {
            let count = 0;
            let app_skills = applicant.querySelectorAll('.app_skill')
                app_skills.forEach(item => {
                    skill = item.innerHTML.toLowerCase().split('(')[0].trim()
                    listing_skills.forEach(element =>{
                        element = element.innerHTML.toLowerCase().trim()
                        if (skill == element){
                            count += 1
                        }
                    })
            })
            
            percent = count/skill_len * 100
            if (!Number.isInteger(percent)){
                percent = percent.toFixed(1)
            }
            console.log(percent)
            let percent_text = applicant.querySelector('.role-skill-match-percent')
            console.log(percent_text)
            percent_text.innerHTML = percent + "%"
            var colour = ""
            if (percent < 50){
                colour = "red"
            }
            else if (percent >=50 & percent < 75){
                colour = "#e3bd42"
            }
            else{
                colour = "darkgreen"
            }
            percent_text.style.color = colour
        })
    }
</script>

</html>
