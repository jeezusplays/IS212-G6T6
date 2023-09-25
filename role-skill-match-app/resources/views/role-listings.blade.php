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
            <a class="navbar-brand" href="#">
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
                    {{-- Retrieve default HR staff name from database --}}
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

        <h1 class="my-3">Role Listings</h1>

        {{-- Loop through your role data and display each role in a card --}}
        <div class="row" id="roleCardsContainer">
            @foreach ($roles as $role)
                <div
                    class="col-xl-4 col-md-6 col-sm-12 role-card @if ($role['status'] == 'Open') open-role @else closed-role @endif">
                    <div class="card mb-3">
                        <a href="#" class="card-title-link">
                            <h5 class="card-header card-title p-3">{{ $role['role'] }}</h5>
                        </a>
                        <div class="card-body">
                            <p class="card-text">Applications received:
                                {{ $role['total_applications'] }}
                                <a href="#" class="@if ($role['total_applications'] > 0)  @endif">[View
                                    Applications]</a>
                            </p>
                            <p class="card-text">Creation Date: {{ $role['created_at'] }}</p>
                            <p class="card-text">Listed By: {{ $role['full_name'] }}</p>
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

        document.querySelectorAll(".role-card").forEach(card => {
            const status = card.classList.contains("open-role") ? "Open" : "Closed";
            const jobTitle = card.querySelector(".card-title").textContent.toUpperCase();

            // Check if the card matches the search input and selected status filters
            if (
                jobTitle.indexOf(currentSearchInput) > -1 &&
                (selectedStatusFilters.length === 0 || selectedStatusFilters.includes(status))
            ) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        });
    }
</script>

</html>
