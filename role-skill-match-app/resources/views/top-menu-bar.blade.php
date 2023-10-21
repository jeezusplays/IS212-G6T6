<div id="app" class="container mb-3">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="http://localhost:8000/browse-roles">
                <img src="{{ asset('favicon-32x32.png') }}" alt="Company Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="javascript:void(0);" onclick="gotoBrowseRoles()">Browse Role Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/my-applications">View Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="javascript:void(0);" onclick="gotoCreateRole()">Create Role Listing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="javascript:void(0);" onclick="gotoMyRoleListings()">All Role Listings</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- Default staff name [Lee Ji Eun, Role id = 1] from database --}}
                    Lee Ji Eun (Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('hr')">HR Staff</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('staff')">Staff</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('manager')">Manager</a></li>
                </ul>
            </div>
        </nav>
</div>

    <style>
        #app .navbar .nav-link {
            color: black; /* Change to the desired color */
        }
    </style>


<script>
    function changeAccess(access) {
        // Get the current URL
        const currentUrl = window.location.href;

        // Extract the part of the URL after the domain, which includes the page
        const urlSegments = currentUrl.split(window.location.origin)[1];

        // Split the URL segments by '/'
        const segments = urlSegments.split('/');
        const page = segments.slice(2);
        
        
        // Construct the new URL with the selected access and the current page
        const newUrl = `${window.location.origin}/${access}/${page.join('/')}`;

        // Navigate to the new URL
        window.location.href = newUrl;
    }

    function gotoBrowseRoles() {

        const currentUrl = window.location.href;

        // Extract the part of the URL after the domain, which includes the page
        const urlSegments = currentUrl.split(window.location.origin)[1];
        
        // Split the URL segments by '/'
        const segments = urlSegments.split('/');  
        access=segments[1]
        
        // Construct the new URL with the selected access and the current page
        const newUrl = `${window.location.origin}/${access}/browse-roles`;

        // Navigate to the new URL
        window.location.href = newUrl;
    }

    function gotoCreateRole() {

        const currentUrl = window.location.href;

        // Extract the part of the URL after the domain, which includes the page
        const urlSegments = currentUrl.split(window.location.origin)[1];

        // Split the URL segments by '/'
        const segments = urlSegments.split('/');  
        access=segments[1]

        // Construct the new URL with the selected access and the current page
        const newUrl = `${window.location.origin}/${access}/create-role`;

        // Navigate to the new URL
        window.location.href = newUrl;
        }

    function gotoMyRoleListings() {

        const currentUrl = window.location.href;

        // Extract the part of the URL after the domain, which includes the page
        const urlSegments = currentUrl.split(window.location.origin)[1];

        // Split the URL segments by '/'
        const segments = urlSegments.split('/');  
        access=segments[1]

        // Construct the new URL with the selected access and the current page
        const newUrl = `${window.location.origin}/${access}/role-listings`;

        // Navigate to the new URL
        window.location.href = newUrl;
        }
    </script>



