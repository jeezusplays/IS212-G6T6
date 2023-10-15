<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/x-icon">
    <style>
        /* Add your custom CSS styles here */
        .card-title-link {
            text-decoration: none;
            /* Remove underline */
            color: inherit;
        }

        .progress {
            border-radius: 0;
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

        .vertical {
            border-right: 1px dotted grey;
            height: 100%;
        }

        /* Updated CSS */
        /* ... */

        .grid-container {
            display: grid;
            grid-gap: 5px;
            /* Add spacing between grid items */
            grid-template-columns: repeat(auto-fill, minmax(150px, 3fr));
            /* Adjust the minimum width as needed */
            padding: 5px;
            /* Add padding to the grid container */
        }

        .skill-item {
            border: 1px solid #ccc;
            /* make border round */
            border-radius: 5px;
            /* Add a border around each skill item */
            padding: 5px;
            /* Add padding to the skill items for spacing */
            /* Make skill-item be in the center of the box */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #f5f5f5;
            /* Background color for skill items */
            font-size: 12px;
        }


        /* ... */
    </style>



    <title>
        Browse Roles
    </title>
</head>

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<body onload="start()">
    {{-- Top Menu Bar --}}
    <div id="app" class="container mb-3">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="http://localhost:8000/browse-roles">
                <img src="{{ asset('favicon-32x32.png') }}" alt="Company Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="http://localhost:8000/browse-roles">Browse Role Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/my-applications">View Applications</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- Default staff name [Lee Ji Eun, Role id = 1] from database --}}
                    Lee Ji Eun (Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings">HR Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/browse-roles">Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-management">Manager</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container">
        <h1 class="mb-3">Browse Role Listings</h1>

        {{-- Search Bar --}}
        <div class="mb-3">
            <form class="d-flex" id = "searchSubmit" onsubmit="searchJobs(); return false;">
                <input class="form-control me-2 form-control-lg" id="myInput" type="search" placeholder="Search by role title" aria-label="Search">
                <button class="btn btn-success form-control-lg" id="searchButton" type="submit">
                    Search
                </button>
            </form>
        </div>

        <div id="searchErrorAlert" class="alert alert-danger" style="display: none;">
            Your search input contains invalid characters and is not supported.
        </div>

        {{-- Filter --}}
        <div class="row">
            <div class="col-md-3 my-3">
                <!-- Filters Section (3 columns) -->
                <select class="form-select mb-3" id="filterDepartment">
                    <option value="" selected>Filter by Department</option>
                    <!-- Add department options dynamically -->
                    @foreach ($departments as $department)
                    <option value="{{ $department }}">{{ $department }}</option>
                    @endforeach
                </select>
                <select class="form-select mb-3" id="filterLocation">
                    <option value="" selected>Filter by Location</option>
                    <!-- Add location options dynamically -->
                    @foreach ($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
                <select class="form-select mb-3" id="filterSkillsets">
                    <option value="" selected>Filter by Skillsets</option>
                    <!-- Add skillset options dynamically -->
                    @foreach ($skills as $skill)
                    <option value="{{ $skill }}">{{ $skill }}</option>
                    @endforeach
                </select>
                <button id="filterButton" class="btn btn-primary w-100 form-control-lg" onclick="searchJobs()">Apply Filters</button>
                <button id="clearFilterButton" class="btn btn-secondary w-100 mt-3 form-control-lg" onclick="clearFilters()">Clear Filters</button>
                <p class = "mt-3" id = "jobListingsCount">0 roles found based on your filters</p>
            </div>


            <!-- Job Listing Card -->
            <div class="col-md-9">
                @foreach ($roles as $role)
                @if ($role['status'] == 'Open')
                <a href="http://localhost:8000/view-role/listingID={{ $role['listing_id'] }}" class="card-title-link">
                    <div class="card my-3 role-card" data-department="{{ $role['department'] }}" data-location="{{ $role['country'] }}">
                        <h5 class="card-title card-header p-3 d-flex justify-content-between align-items-center" style="background-color: #dbeffc">{{ $role['role'] }} ({{ $role['work_arrangement'] }})
                            <a href="http://localhost:8000/view-role/listingID={{ $role['listing_id'] }}" class="btn btn-sm btn-outline-primary">View Details</a>
                        </h5>
                </a>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9 vertical">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-diagram-3" viewBox="0 0 16 16" style="display: inline;">
                                <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                            </svg>
                            <p class="card-text d-inline"><b>Department: </b>{{ $role['department'] }}</p>
                            <p></p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16" style="display: inline;">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                            </svg>
                            <p class="card-text d-inline"><b>Location: </b>{{ $role['country'] }}</p>
                            <p></p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16" style="display: inline;">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                            </svg>
                            <p class="card-text mb-0 mt-3 d-inline"><b>Skills:</b>
                            <div class="grid-container">
                                @foreach ($role['skills'] as $index => $skill)
                                <div class="skill-item" id="skilldata" data-skillsets="{{ json_encode($role['skills']) }}">{{ $skill }}</div>
                                @endforeach
                            </div>
                            </p>
                            <!-- Insert placeholder Dotted Progress Bar here to represent skill match, should not overlap past 9 column-->
                            @php
                                $match = array_intersect($role['skills'],$staff_skills);
                                $skill_match_percent = count($match) / count($role['skills']) * 100;

                                $missing_skills = array_diff($role['skills'], $match);
                                $width = $skill_match_percent . '%';
                            @endphp
                            <span class="sr-only skill-match-text" style="color:darkgreen;"><b>{{$skill_match_percent}}% Skills Matched</b></span>
                            <div class="progress my-3">
                                <!-- Adjust both valuenow and width to reflect progress -->
                                <div class="progress-bar skill-match-progressbar"  role="progressbar" aria-valuenow="{{$skill_match_percent}}" aria-valuemin="0" aria-valuemax="100" style="background-color:darkgreen; width: {{ $width }};"> <!-- width: {{$width}}; -->
                                    <div class="progress-stripes"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="my-4">
                                <p class="card-text"><i>{{ $role['total_applications'] }} applications</i></p>
                                <p class="card-text" id="dateSincePost" data-laravel-variable-1="{{ $role['created_at'] }}" data-toggle="tooltip" data-placement="top" title="">
                                Created {{ $role['days_from_creation'] }} days ago
                                </p>
                                <p class="card-text" id="card-status" data-laravel-variable-2="{{ $role['deadline'] }}" data-toggle="tooltip" data-placement="top" title="Application Closes on {{ $role['deadline'] }}">
                                    <b>Status:</b>
                                    @if ($role['status'] == 'Open')
                                    <span class="text-success">Open</span>
                                    @else
                                    <span class="text-danger">Closed</span>
                                    @endif
                                </p>
                                <p class ="card-text">
                                    <i>Application closes in <u>{{ $role['days_until_deadline'] }} days</u> on {{ $role['deadline'] }}</i>
                                </p>

                            </div>
                            <div class="mt-3">
                                <a href="#" class="btn btn-success">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach


            <div id="no-matching-results" class="card mb-3" style="display: none;">
                <div class="card-body">
                    <h5 class="card-title">No matching results</h5>
                    <p class="card-text">
                        Sorry, there are no job listings that match your search criteria. Please try
                        refining your search.
                    </p>
                </div>
            </div>
        </div>

    </div>
    </div>
</body>

<script>
    // Search bar functionality
    function start(){
        searchJobs();
        progressColorChange();
    }

    function searchJobs() {
        const selectedSkillset = document.getElementById('filterSkillsets').value;
        const input = document.getElementById('myInput');
        const filter = input.value.toUpperCase();
        var counter = 0;
        document.querySelectorAll(".role-card").forEach(card => {
            const title = card.querySelector(".card-title").innerText.toUpperCase();
            const text = card.querySelector(".card-text").innerText.toUpperCase();
            const skills = card.querySelector(".skill-item");

            if (title.indexOf(filter) > -1 || text.indexOf(filter) > -1) {
                // If department and location filter matches, display the card
                let department_filter = document.getElementById("filterDepartment").value;
                let location_filter = document.getElementById("filterLocation").value;
                if (department_filter == "" || department_filter == card.getAttribute('data-department')) {
                    if (location_filter == "" || location_filter == card.getAttribute('data-location')) {
                        if (skills && skills.getAttribute('data-skillsets').includes(selectedSkillset)) {
                            card.style.display = "";
                            counter++;
                        } else if (selectedSkillset == "") {
                            card.style.display = "";
                            counter++;
                        } else {
                            card.style.display = "none";
                        }
                    } else {
                        card.style.display = "none";
                    }
                } else {
                    card.style.display = "none";
                }
            } else {
                card.style.display = "none";
            }
        });

        if (counter == 0) {
            document.getElementById("no-matching-results").style.display = "";
        } else {
            document.getElementById("no-matching-results").style.display = "none";
        }

        // Check if the search input contains invalid characters
        if (filter.match(/^[a-zA-Z0-9 ]*$/)) {
            document.getElementById("searchErrorAlert").style.display = "none";
        } else {
            document.getElementById("searchErrorAlert").style.display = "";
        }

        // Update and display the job listings count
        document.getElementById('jobListingsCount').textContent = `${counter} roles found based on your filters`;
    }

    // Function to clear all filters
    function clearFilters() {
        // Clear the filter inputs and show all role cards
        document.getElementById('filterDepartment').selectedIndex = 0;
        document.getElementById('filterLocation').selectedIndex = 0;
        document.getElementById('filterSkillsets').selectedIndex = 0;

        document.querySelectorAll(".role-card").forEach(card => {
            card.style.display = "";
        });
        searchJobs();
    }

    function progressColorChange(){
        var text_arr = document.getElementsByClassName('skill-match-text')
        var progress_arr = document.getElementsByClassName('skill-match-progressbar')
        for (var i = 0; i < text_arr.length; i++) {
            var skill_match_text = text_arr[i]
            var skill_match_progress = progress_arr[i]
            var percent = skill_match_progress.getAttribute('aria-valuenow')

            console.log(skill_match_progress)
            console.log(skill_match_text)
            
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
            skill_match_text.style.color = colour
            skill_match_progress.style.backgroundColor = colour
        }
        // var skill_match_text = document.getElementById('skill-match-text');
        // var skill_match_progress = document.getElementById('skill-match-progressbar');
        // var percent = skill_match_progress.getAttribute('aria-valuenow');
        
    }

</script>

</html>