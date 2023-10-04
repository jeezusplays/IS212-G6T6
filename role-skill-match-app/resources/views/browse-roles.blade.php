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
            /* Inherit the card title's original text color */
            /* Add any additional styling you desire */
        }
    </style>
    <title>
        Browse Roles
    </title>
</head>

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<body>
    {{-- Top Menu Bar --}}
    <div id="app" class="container mb-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="http://localhost:8000/browse-roles">
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
        <h1 class="mb-3">Browse Job Roles</h1>

        {{-- Search Bar --}}
        <div class="mb-3">
            <form class="d-flex" onsubmit="searchJobs(); return false;">
                <input class="form-control me-2 form-control-lg" id="myInput" type="search" placeholder="Search by Job Title" aria-label="Search">
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
                <form action="{{ route('browse-roles') }}" method="GET">
                    @csrf
                    <!-- Filters Section (3 columns) -->
                    <select class="form-select mb-3" id="filterDepartment">
                        <option value="" selected>Filter by Department</option>
                        <!-- {{-- Add department options dynamically --}} -->
                        @foreach ($departments as $department)
                        <option value="{{ $department }}">{{ $department }}</option>
                        @endforeach
                    </select>
                    <select class="form-select mb-3" id="filterLocation">
                        <option value="" selected>Filter by Location</option>
                        {{-- Add location options dynamically --}}
                        @foreach ($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                    <select class="form-select mb-3" id="filterSkillsets">
                        <option value="" selected>Filter by Skillsets</option>
                        {{-- Add skillset options dynamically --}}
                        @foreach ($skills as $skill)
                        <option value="{{ $skill }}">{{ $skill }}</option>
                        @endforeach
                    </select>
                    <button id="filterButton" class="btn btn-primary w-100" onclick="filterJobs()">Apply Filters</button>
                </form>
            </div>

            <!-- Job Listing Card -->
            <div class="col-md-9">
                @foreach ($roles as $role)
                <a href="http://localhost:8000/listingID={{ $role['listing_id'] }}" class="card-title-link">
                    <div class="card my-3 role-card">
                        <h5 class="card-title card-header p-3 d-flex justify-content-between align-items-center" style="background-color: #dbeffc">{{ $role['role'] }} ({{ $role['work_arrangement'] }})
                            <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                        </h5>
                </a>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <p class="card-text"><b>Department: </b>{{ $role['department'] }}</p>
                            <p class="card-text"><b>Location: </b>{{ $role['country'] }}</p>
                            <p class="card-text"><b>Created on: </b>{{ $role['created_at'] }}</p>
                            <p class="card-text"><b>Skills:</b>
                                @foreach ($role['skills'] as $index => $skill)
                                {{ $skill }}@if (!$loop->last), @endif
                                @endforeach
                            </p>
                            <p class="card-text" id="card-status">
                                <b>Status:</b>
                                @if ($role['status'] == 'Open')
                                <span class="text-success">Open</span> (<i>Application Closes on: {{ $role['deadline'] }} </i>)
                                @else
                                <span class="text-danger">Closed</span> (<i>Application Closes on: {{ $role['deadline'] }} </i>)
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-3">
                            <div class="my-4">
                               <p class="card-text"><i>{{ $role['total_applications'] }} Applications</i></p>
                               <p class="card-text" id = "dateSincePost" data-laravel-variable="{{ $role['created_at'] }}"></p>
                            </div>
                            <div class="mt-5">
                                <a href="#" class="btn btn-success">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    // Find number of days since job listing was posted from created_at variable and append to dateSincePost element
    document.querySelectorAll(".role-card").forEach(card => {
        var created_at = document.getElementById('dateSincePost').getAttribute('data-laravel-variable');
        const dateSincePost = card.querySelector("#dateSincePost");
        const date = new Date(created_at);
        const today = new Date();
        const diffTime = Math.abs(today - date);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        dateSincePost.innerText = "Posted " + diffDays + " days ago";
    });

    
    // Search bar functionality
    function searchJobs() {
        const input = document.getElementById('myInput');
        const filter = input.value.toUpperCase();
        var counter = 0;
        document.querySelectorAll(".role-card").forEach(card => {
            const title = card.querySelector(".card-title").innerText.toUpperCase();
            const text = card.querySelector(".card-text").innerText.toUpperCase();
            if (title.indexOf(filter) > -1 || text.indexOf(filter) > -1) {
                card.style.display = "";
                counter++;
            } else {
                card.style.display = "none";
            }
        });
        if (counter == 0) {
            document.getElementById("no-matching-results").style.display = "";
        } else {
            document.getElementById("no-matching-results").style.display = "none";
        }
    }

    // Search bar error handling
    const searchButton = document.getElementById('searchButton');
    const searchErrorAlert = document.getElementById('searchErrorAlert');
    const myInput = document.getElementById('myInput');
    searchButton.addEventListener('click', () => {
        const input = myInput.value;
        if (input.match(/^[a-zA-Z0-9 ]*$/)) {
            searchErrorAlert.style.display = 'none';
        } else {
            searchErrorAlert.style.display = '';
        }
    });

    // Filter functionality for dropdowns to apply to role cards
    function filterJobs() {
        // Collect selected filter values
        const departmentFilter = document.getElementById('filterDepartment').value;
        const locationFilter = document.getElementById('filterLocation').value;
        const skillsetFilter = document.getElementById('filterSkillsets').value;
    }
</script>

</html>