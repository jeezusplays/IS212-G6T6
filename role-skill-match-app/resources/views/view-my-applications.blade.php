<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/x-icon">
    <style>
        /* Add your custom CSS styles here */
        .progress {
            border-radius: 0;
            background-color: lightgrey;
            box-shadow: none;
            width: 75%;
            position: relative;
        }

        .progress-bar {
            background-color: green !important;
            height: 20px;
            /* Adjust the height as needed */
        }

        .progress-stages {
            display: flex;
            justify-content: space-between;
        }

        .stage {
            text-align: center;
            flex-grow: 1;
            font-size: 14px;
            /* Adjust the font size as needed */
            white-space: nowrap;
            color: #9CA3AF;
            /* Prevent text from wrapping */
        }

        .stage-at {
            text-align: center;
            flex-grow: 1;
            font-size: 14px;
            /* Adjust the font size as needed */
            white-space: nowrap;
            font-weight: bold;
            /* Prevent text from wrapping */
        }
        

        .card-title-link {
            text-decoration: none;
            /* Remove underline */
            color: inherit;
        }

        .vertical {
            border-right: 1px dotted grey;
            height: 100%;
        }

        .grid-container {
            display: grid;
            grid-gap: 5px;
            /* Add spacing between grid items */
            grid-template-columns: repeat(auto-fill, minmax(150px, 3fr));
            /* Adjust the minimum width as needed */
            padding: 5px;
            /* Add padding to the grid container */
        }
    </style>



    <title>
        My Applications
    </title>
</head>

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<body onload="start()">
    {{-- Top Menu Bar --}}
    @include('top-menu-bar')

    <div class="container">
        <h1 class="mb-3">My Applications</h1>

        {{-- Search Bar --}}
        <div class="mb-3">
            <form class="d-flex" id = "searchSubmit" onsubmit="searchJobs(); return false;">
                <input class="form-control me-2 form-control-lg" id="myInput" type="search"
                    placeholder="Search by role title" aria-label="Search">
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
                    <option value="" selected disabled>Filter by Department</option>
                    <!-- Add department options dynamically -->
                    @foreach ($departments as $department)
                        <option value="{{ $department }}">{{ $department }}</option>
                    @endforeach
                </select>
                <select class="form-select mb-3" id="filterLocation">
                    <option value="" selected disabled>Filter by Location</option>
                    <!-- Add location options dynamically -->
                    @foreach ($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
                <button id="filterButton" class="btn btn-primary w-100 form-control-lg" onclick="searchJobs()">Apply
                    Filters</button>
                <button id="clearFilterButton" class="btn btn-secondary w-100 mt-3 form-control-lg"
                    onclick="clearFilters()">Clear Filters</button>
                <p class = "mt-3" id = "jobListingsCount">0 roles found based on your filters</p>
            </div>


            <!-- Job Listing Card -->
            <div class="col-md-9">
                @foreach ($roles as $role)
                    <a href="javascript:void(0);" class="card-title-link">
                        <div class="card my-3 role-card" data-department="{{ $role['department'] }}"
                            data-location="{{ $role['country'] }}">
                            <h5 class="card-title card-header p-3 d-flex justify-content-between align-items-center"
                                style="background-color: #dbeffc">{{ $role['role'] }}
                            </h5>
                    </a>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9 vertical">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-diagram-3" viewBox="0 0 16 16"
                                    style="display: inline;">
                                    <path fill-rule="evenodd"
                                        d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                                </svg>
                                <p class="card-text d-inline"><b>Department: </b>{{ $role['department'] }}</p>
                                <p></p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16"
                                    style="display: inline;">
                                    <path
                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                </svg>
                                <p class="card-text d-inline"><b>Location: </b>{{ $role['country'] }}</p>
                                <!-- Progress Tracker -->
                                <div class="progress mt-3">
                                    @if ($role['application_status'] == 1)
                                        <div class="progress-bar bg-info" style="width: 20%;"></div>
                                        <div class="stage-marker stage-applied"></div>
                                    @elseif ($role['application_status'] == 2)
                                        <div class="progress-bar bg-primary" style="width: 40%;"></div>
                                        <div class="stage-marker stage-hr-received"></div>
                                    @elseif ($role['application_status'] == 3)
                                        <div class="progress-bar bg-primary" style="width: 60%;"></div>
                                        <div class="stage-marker stage-interview-scheduled"></div>
                                    @elseif ($role['application_status'] == 4)
                                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                                        <div class="stage-marker stage-accepted-rejected"></div>
                                    @elseif ($role['application_status'] == 5)
                                        <div class="progress-bar bg-danger" style="width: 100%;"></div>
                                    @else
                                        <div class="progress-bar" style="width: 0%;"></div>
                                        <div class="stage-marker stage-withdrawn"></div>
                                    @endif
                                </div>

                                <div class="progress-stages mt-1" style = "width: 75%">
                                    @if ($role['application_status'] == 6)
                                    <div class="stage-at">Withdrawn</div>
                                    @else
                                    <div class="stage">Withdrawn</div>
                                    @endif
                                    
                                    @if ($role['application_status'] == 1)
                                    <div class="stage-at">Applied</div>
                                    @else
                                    <div class="stage">Applied</div>
                                    @endif

                                    @if ($role['application_status'] == 2)
                                    <div class="stage-at">HR Received</div>
                                    @else
                                    <div class="stage">HR Received</div>
                                    @endif

                                    @if ($role['application_status'] == 3)
                                    <div class="stage-at">Interview Scheduled</div>
                                    @else
                                    <div class="stage">Interview Scheduled</div>
                                    @endif

                                    @if ($role['application_status'] == 4)
                                    <div class="stage-at">Accepted</div>
                                    @elseif ($role['application_status'] == 5)
                                    <div class="stage-at">Rejected</div>
                                    @else
                                    <div class="stage">Offer</div>
                                    @endif

                                </div>


                            </div>
                            <div class="col-lg-3">
                                <div class="my-4">
                                    <p class="card-text" id="dateSincePost"
                                        data-laravel-variable-1="{{ $role['num_days_since_application'] }}"
                                        data-toggle="tooltip" data-placement="top" title="">
                                        Applied {{ $role['num_days_since_application'] }} days ago
                                    </p>
                                    <p class = "card-text">
                                        Last updated on: {{ $role['updated_at'] }}
                                    </p>
                                    <b>Status:</b>
                                    @if ($role['application_status'] == 1)
                                        <span
                                            class="badge rounded-pill bg-info
                                            ">Applied
                                        </span>
                                    @elseif ($role['application_status'] == 2)
                                        <span
                                            class="badge rounded-pill bg-primary
                                            ">HR
                                            Received
                                        </span>
                                    @elseif ($role['application_status'] == 3)
                                        <span
                                            class="badge rounded-pill bg-primary
                                            ">Interview
                                            Scheduled
                                        </span>
                                    @elseif ($role['application_status'] == 4)
                                        <span
                                            class="badge rounded-pill bg-success
                                            ">Accepted
                                        </span>
                                    @elseif ($role['application_status'] == 5)
                                        <span
                                            class="badge rounded-pill bg-danger
                                            ">Rejected
                                        </span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-secondary
                                            ">Withdrawn
                                        </span>
                                    @endif

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
    // Search bar functionality
    function start() {
        triggerTooltip()
        searchJobs();
    }

    function searchJobs() {
        const input = document.getElementById('myInput');
        const filter = input.value.toUpperCase();
        var counter = 0;
        document.querySelectorAll(".role-card").forEach(card => {
            const title = card.querySelector(".card-title").innerText.toUpperCase();
            const text = card.querySelector(".card-text").innerText.toUpperCase();

            if (title.indexOf(filter) > -1 || text.indexOf(filter) > -1) {
                // If department and location filter matches, display the card
                let department_filter = document.getElementById("filterDepartment").value;
                let location_filter = document.getElementById("filterLocation").value;
                if (department_filter == "" || department_filter == card.getAttribute('data-department')) {
                    if (location_filter == "" || location_filter == card.getAttribute('data-location')) {
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

    function triggerTooltip() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    }

    // Function to clear all filters
    function clearFilters() {
        // Clear the filter inputs and show all role cards
        document.getElementById('filterDepartment').selectedIndex = 0;
        document.getElementById('filterLocation').selectedIndex = 0;

        document.querySelectorAll(".role-card").forEach(card => {
            card.style.display = "";
        });
        searchJobs();
    }

    function gotoViewRole(listingid) {

        const currentUrl = window.location.href;

        // Extract the part of the URL after the domain, which includes the page
        const urlSegments = currentUrl.split(window.location.origin)[1];

        // Split the URL segments by '/'
        const segments = urlSegments.split('/');
        access = segments[1]

        // Construct the new URL with the selected access and the current page
        const newUrl = `${window.location.origin}/${access}/view-role/listingID=${listingid}`;

        // Navigate to the new URL
        window.location.href = newUrl;


    }
</script>

</html>
