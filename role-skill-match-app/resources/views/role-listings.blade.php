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
    <Title>
        Role Listings
    </Title>
</head>

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<body>
    {{-- Top Menu Bar --}}
    <div id="app" class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                    {{-- Retrieve default HR staff name [Park Bo Gum, Role id = 5] from database --}}
                    {{ $roles[4]['full_name'] }} (HR Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings">HR Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-staff">Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-manager">Manager</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container">
        {{-- Search Bar and Filter Bar --}}
        <div class="row justify-content-between">
            <div class="col-md-5 p-3 d-flex">
                <div class="input-group">
                    <input style="display:inline-block; position:relative" type="text" class="form-control"
                        placeholder="Search for roles" id="myInput">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="searchJobs()"
                            id="searchbutton">Search</button>
                    </div>
                </div>
            </div>

            <!-- Filter by Status Dropdown Checkbox -->
            <div class="col-md-6 p-3 d-flex justify-content-end">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" id="filterButton">
                        Filter by Status
                    </button>
                    <div class="dropdown-menu" id="filterDropdown" style="max-height: 200px; overflow-y: auto;">
                        <label class="dropdown-item">
                            <input type="checkbox" class="status-filter" value="Open" checked> Open
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" class="status-filter" value="Closed" checked> Closed
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div id="searchErrorAlert" class="alert alert-danger" style="display: none;">
            Your search input contains invalid characters and is not supported.
        </div>

        <h1 class="my-3">Role Listings</h1>

        {{-- Loop through your role data and display each role in a card --}}
        <div class="row" id="roleCardsContainer">
            @foreach ($roles as $role)
                <div
                    class="col-xl-4 col-md-6 col-sm-12 role-card @if ($role['status'] == 'Open') open-role @else closed-role @endif">
                    <div class="card mb-3">
                        <a href="http://localhost:8000/view/listingID={{ $role['listing_id'] }}"
                            class="card-title-link">
                            <div class="card-header card-title p-3 d-flex justify-content-between align-items-center">
                                <h5 class="m-0">{{ $role['role'] }} ({{ $role['work_arrangement'] }})</h5>
                                <a href="http://localhost:8000/edit/listingID={{ $role['listing_id'] }}"
                                    class="btn btn-sm btn-outline-primary">
                                    Edit Listing
                                </a>
                            </div>
                        </a>
                        <div class="card-body">
                            <p class="card-text">Applications received:
                                {{ $role['total_applications'] }}
                                <a href="#" class="@if ($role['total_applications'] > 0)  @endif">[View
                                    Applications]</a>
                            </p>
                            <p class="card-text">Creation Date: {{ $role['created_at'] }}</p>
                            <p class="card-text">Listed By: {{ $role['full_name'] }}</p>
                            <p class="card-text">Vacancy: {{ $role['vacancy'] }}</p>
                            <p class="card-text" id="card-status">
                                Status:
                                @if ($role['status'] == 'Open')
                                    <span class="text-success">Open</span>
                                @else
                                    <span class="text-danger">Closed</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
</body>

<script>
    // Search bar functionality on enter key press
    document.getElementById("myInput").addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("searchbutton").click();
        }
    });

    let currentSearchInput = "";

    // Search bar functionality
    function searchJobs() {
        const input = document.getElementById("myInput");
        sanitizeAndCheckInput(input.value);
        currentSearchInput = input.value.toUpperCase();
        applyFilters();
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Filter by Status functionality
        const checkboxes = document.querySelectorAll(".status-filter");
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", applyFilters);
        });
    });

    function applyFilters() {
        const selectedStatusFilters = Array.from(document.querySelectorAll(".status-filter:checked")).map(checkbox =>
            checkbox.value);
        var counter = 0;

        document.querySelectorAll(".role-card").forEach(card => {
            const status = card.classList.contains("open-role") ? "Open" : "Closed";
            const jobTitle = card.querySelector(".card-title").textContent.toUpperCase();
            // Check if the card matches the search input and selected status filters
            if (selectedStatusFilters.length == 0) {
                card.style.display = "none";
                counter++;
            }
            else if (jobTitle.indexOf(currentSearchInput) > -1 &&
                (selectedStatusFilters.length === 0 || selectedStatusFilters.includes(status))
            ) {
                card.style.display = "";
            
            } else {
                card.style.display = "none";
                counter++;
            }
        });
        
        // Check if there are any visible cards
        if (counter == document.querySelectorAll(".role-card").length) {
            // If no visible cards, display the placeholder card
            document.getElementById("no-matching-results").style.display = "block";
        } else {
            // If there are visible cards, hide the placeholder card
            document.getElementById("no-matching-results").style.display = "none";
        }
    }

    function sanitizeAndCheckInput(input) {
        // Define a regular expression pattern for valid alphanumeric characters (letters and numbers)
        const alphanumericPattern = /^[a-zA-Z0-9]+$/;

        // Remove all spaces from the input
        const sanitizedInput = input.replace(/\s/g, '');

        // Use the test method to check if the input contains only valid characters
        const isValid = alphanumericPattern.test(sanitizedInput);

        if (!isValid && sanitizedInput !== "") {
            document.getElementById("searchErrorAlert").style.display = "block";
        }
        else {
            document.getElementById("searchErrorAlert").style.display = "none";
        }
    }

</script>

</html>
