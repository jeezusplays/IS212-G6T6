<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/x-icon">
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<body>
    <div id="app" class="container">
        {{-- Top Menu Bar --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('favicon-32x32.png') }}" alt="Company Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">View Role Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Create Role Listing</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Current User's Name (HR Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">HR Staff</a></li>
                    <li><a class="dropdown-item" href="#">Staff</a></li>
                    <li><a class="dropdown-item" href="#">Manager</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container">
        {{-- Search Bar and Filter Bar --}}
        <div class="row justify-content-between">
            <div class="col-md-5 p-3 d-flex">
                <div class="input-group">
                    <input style="display:inline-block; position:relative" type="text" class="form-control" placeholder="Search for roles" id="myInput">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="searchJobs()" id="searchbutton">Search</button>
                    </div>
                </div>
            </div>

            <!-- Filter by Status Dropdown Checkbox -->
            <div class="col-md-6 p-3 d-flex">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        id="filterButton">
                        Filter by Status
                    </button>
                    <div class="dropdown-menu" id="filterDropdown" style="max-height: 200px; overflow-y: auto;">
                        <label class="dropdown-item">
                            <input type="checkbox" class="status-filter" value="Open"> Open
                        </label>
                        <label class="dropdown-item">
                            <input type="checkbox" class="status-filter" value="Closed"> Closed
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <h1>Role Listings</h1>

        {{-- Loop through your role data and display each role in a card --}}
        <div class="container">
            <div class="row" id="roleCardsContainer">
                @foreach ($roles as $role)
                <div class="col-xl-4 col-md-6 col-sm-12 role-card @if ($role['Status'] == 1) open-role @else closed-role @endif">
                    <div class="card mb-3">
                        <h5 class="card-header card-title p-3">{{ $role['Role Name'] }}</h5>
                        <div class="card-body">
                            <p class="card-text">Applications received: <a href="#"><u>{{ $role['Total_Applications'] }}</u></a></p>
                            <p class="card-text">Creation Date: {{ $role['Creation_Date'] }}</p>
                            <p class="card-text">Listed By: {{ $role['Created_By'] }}</p>
                            <p class="card-text" id="card-status">
                                Status:
                                @if ($role['Status'] == 1)
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
    </div>

    <script>
        // Search bar functionality on enter key press
        document.getElementById("myInput").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("searchbutton").click();
            }
        });

        // Search bar functionality
        function searchJobs() {
            const input = document.getElementById("myInput");
            const filter = input.value.toUpperCase();
            const roleCards = document.querySelectorAll(".role-card");

            roleCards.forEach(card => {
                const jobTitle = card.querySelector(".card-title").textContent.toUpperCase();
                if (jobTitle.indexOf(filter) > -1) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Filter by Status functionality
            const checkboxes = document.querySelectorAll(".status-filter");
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", applyFilters);
            });
        });

        function applyFilters() {
            const selectedStatusFilters = Array.from(document.querySelectorAll(".status-filter:checked")).map(checkbox => checkbox.value);

            if (selectedStatusFilters.length === 0) {
                // Show all cards if no filters are selected
                document.querySelectorAll(".role-card").forEach(card => card.style.display = "");
            } else {
                // Show cards based on selected filters
                document.querySelectorAll(".role-card").forEach(card => {
                    const status = card.classList.contains("open-role") ? "Open" : "Closed";
                    if (selectedStatusFilters.includes(status)) {
                        card.style.display = "";
                    } else {
                        card.style.display = "none";
                    }
                });
            }
        }
    </script>
</body>

</html>
