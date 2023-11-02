<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Role</title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <!-- Popper.js CDN -->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <style>
        #grey-box {
            background-color: rgb(223, 231, 242);
        }

        .skill-item {
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

        .progress {
            border-radius: 25;
            background-color: lightgrey;
            /* Set the background color to light grey */
            box-shadow: none;
            width: 75%;
            position: relative;
        }

        .progress-bar {
            background-color: green;
            /* Set the background color to green for the matched percentage */
            height: 100%;
        }

        .progress-stripes {
            background: repeating-linear-gradient(to right,
                    rgba(0, 0, 0, 0),
                    rgba(0, 0, 0, 0) 9%,
                    white 9%,
                    white 10.1%);
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
        }
    </style>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon-32x32.png') }}">
</head>

<body onload = "start()">
    <div id="app" class="container mb-3">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="http://localhost:8000/browse-roles">
                <img src="{{ asset('favicon-32x32.png') }}" alt="Company Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="http://localhost:8000/browse-roles/staff_id=2">Browse Role
                            Listings</a> <!-- staff id needs to be dynamic -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/my-applications">View Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/indicate-skill-proficiency/staffID=1">My Skill
                            Proficiency</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="true">
                    <!-- {{-- Default staff name [Lee Ji Eun, Role id = 1] from database --}} -->
                    Lee Ji Eun (Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings">HR Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/browse-roles/staff_id=2">Staff</a></li>
                    <!-- staff id needs to be dynamic -->
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-management">Manager</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-sm">
        @if ($isRoleValid)
            @foreach ($roles as $role)
                <div class="row mt-5 mb-4">
                    <div class="col-12 col-sm-8 text-start">
                        <h1>{{ $role['role'] }} ({{ $role['work_arrangement'] == 1 ? 'Part Time' : 'Full Time' }})</h1>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="d-flex justify-content-start justify-content-sm-end">
                            {{-- Insert validation to fetch status of application and display withdraw application button if applied --}}
                            {{-- Only condition to not display the button is if the user has not applied or already withdrawn --}}
                            @if ($role['application'] != 0)
                                @if ($role['application'] != 6)
                                    <button type ="button" class = "btn btn-outline-danger mx-2">Withdraw Application</button>
                                @else
                                    <button type="button" class="btn btn-success btn-md btn-lg">Apply Now</button>  
                                @endif
                            @else
                                <button type="button" class="btn btn-success btn-md btn-lg">Apply Now</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row p-3 gy-2 gy-sm-0" id="grey-box">
                    <div class="col-12 col-sm-4">
                        <b>Department</b> {{ $role['department'] }}
                    </div>
                    <div class="col-12 col-sm-4">
                        <b>Country</b> {{ $role['country'] }}
                    </div>
                    <div class="col-12 col-sm-4">
                        <b>Vacancy</b> {{ $role['vacancy'] }}
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col">
                        <h3>Job Description</h3>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                        {{ $role['description'] }}
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col">
                        <h3>Skills</h3>
                    </div>
                </div>
                @php
                    $arr = [];
                    foreach ($staff_skills as $item => $skill_item) {
                        $skill = $skill_item->skill;
                        $arr[] = $skill;
                    }

                    $match = array_intersect($role['skills'], $arr);
                    $skill_match_percent = (count($match) / count($role['skills'])) * 100;

                    //round to 1dp
                    $skill_match_percent = round($skill_match_percent, 1);

                    $missing_skills = array_diff($role['skills'], $match);
                    $width = $skill_match_percent . '%';

                @endphp
                <div class="row mt-2">

                    <div class="col">
                        @foreach ($role['skills'] as $skill)
                            @if (in_array($skill, $missing_skills))
                                <button class="skill-item"><del><a href="#"
                                            style="text-decoration: none; color:black;" data-bs-toggle="tooltip"
                                            data-bs-title="You do not possess this skill required by the job">{{ $skill }}</a></del></button>
                            @else
                                <button class="skill-item">{{ $skill }}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <span class="sr-only skill-match-text" style="color:darkgreen;"><b>{{ $skill_match_percent }}%
                                Skills Matched</b></span>
                        <div class="progress my-3">
                            <!-- Adjust both valuenow and width to reflect progress -->
                            <div class="progress-bar skill-match-progressbar" role="progressbar"
                                aria-valuenow="{{ $skill_match_percent }}" aria-valuemin="0" aria-valuemax="100"
                                @style("width: {$width};") style = "background-color:darkgreen;">
                                <div class="progress-stripes"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <h3>Vacancy</h3>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                        {{ $role['vacancy'] }} positions
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col text-danger">
                        This listing closes on {{ $role['deadline'] }}
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-danger">
                Invalid Role
            </div>
        @endif
        {{-- Invisible div class to store application_id value --}}
        <div class="d-none" id="application_id">{{ $role['application_id'] }}</div>
    </div>

</body>

<script>
    function start() {
        triggerTooltip();
        progressColorChange();
    }

    function triggerTooltip() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    }

    function progressColorChange() {
        var text_arr = document.getElementsByClassName('skill-match-text')
        var progress_arr = document.getElementsByClassName('skill-match-progressbar')
        for (var i = 0; i < text_arr.length; i++) {
            var skill_match_text = text_arr[i]
            var skill_match_progress = progress_arr[i]
            var percent = skill_match_progress.getAttribute('aria-valuenow')

            console.log(skill_match_progress)
            console.log(skill_match_text)

            var colour = ""
            if (percent < 50) {
                colour = "red"
            } else if (percent >= 50 & percent < 75) {
                colour = "#e3bd42"
            } else {
                colour = "darkgreen"
            }
            skill_match_text.style.color = colour
            skill_match_progress.style.backgroundColor = colour
        }
    }

    // Function to handle application withdrawal
    function withdrawApplication() {
        // Fetch the application_id, listing_id, and staff_id from the webpage
        const application_id = document.getElementById('application_id').innerText;
        // Assume currentUrl is in the format http://localhost:8000/view-role/listingID=3/staff_id=1, fetch listingID and staff_id
        const currentUrl = window.location.href;
        const listing_id = currentUrl.split('/')[4].split('=')[1];
        const staff_id = currentUrl.split('/')[5].split('=')[1];


        // Prepare the data to be sent
        const application_data = {
            application_id,
            listing_id,
            staff_id,
        };

        // Make a POST request to the /withdraw route
        axios.post('/withdraw', {data: application_data})
            .then(response => {
                // Handle the response, e.g., show a success message
                console.log(response)
                // Reload the page once swal is closed
                swal({
                    title: "Success!",
                    text: response.data.message,
                    icon: "success",
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                // Handle errors, e.g., show an error message
                console.log(error)
                swal('Error', 'An error occurred while withdrawing the application.', 'error');
            });
    }

    // Attach an event listener to the "Withdraw Application" button
    const withdrawButton = document.querySelector('.btn-outline-danger');
    if (withdrawButton) {
        withdrawButton.addEventListener('click', withdrawApplication);
    }
</script>

</html>
