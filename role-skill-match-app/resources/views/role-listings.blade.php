<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/x-icon">
    <style>

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
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
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
        {{-- Search Bar --}}
        <div class="row justify-content-center">
            <div class="col-md-8 p-3 d-flex">
                <div class="input-group">
                    <input style="display:inline-block; position:relative" type="text" class="form-control"
                        placeholder="Search for roles" id="myInput">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick=searchJobs()
                            id="searchbutton">Search</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Bar --}}
        <div class="container">
            <h3>FILTER BY</h3>

            <!-- Filter by button and dropdown -->

            <div class="btn-group mb-3">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Filter by Status
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-status="Open">Open</a>
                    <a class="dropdown-item" href="#" data-status="Closed">Closed</a>
                </div>
            </div>

            <br>

            <h1>Role Listings</h1>

            {{-- Loop through your role data and display each role in a card --}}
            @foreach ($roles as $role)
                <div class="card mb-3">
                    <h5 class="card-header card-title p-3">{{ $role['Role_Name'] }}</h5>
                    <div class="card-body">
                      
                        <p class="card-text">Creation Date: {{ $role['Creation_Date'] }}</p>
                        <p class="card-text">Listed By: {{ $role['Created_By'] }}</p>
                        <p class="card-text">
                            Status:
                            @if ($role['Status'] === 'Open')
                                <span class="text-success">Open</span>
                            @else
                                <span class="text-danger">Closed</span>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>


        {{-- Role Listings --}}
        <table class="table table-striped table-bordered" id="job_role_table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Total Applications</th>
                    <th>Creation Date</th>
                    <th>Listed By</th>
                    <th onclick="sortTable(4)">Status</th>
                </tr>
            </thead>

            {{-- Loop through your role data and display it here --}}
            <tbody class="table-group-divider">
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role['Role_Name'] }}</td>
                        <td>{{ $role['Creation_Date'] }}</td>
                        <td>{{ $role['Created_By'] }}</td>
                        <td>
                            @if ($role['Status'] === 1)
                                <p class="text-success">Open</p>
                            @else
                                <p class="text-danger">Closed</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>


    </div>

    <script>
        // Search bar functionality on enter key press
        document.getElementById("myInput")
            .addEventListener("keyup", function(event) {
                event.preventDefault();
                if (event.keyCode === 13) {
                    document.getElementById("searchbutton").click();
                }
            });

        // Search bar functionality
        function searchJobs() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("job_role_table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        // Sort table by column number n, where n is the nth column starting from 0 on the left
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("job_role_table");
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</body>

</html>
