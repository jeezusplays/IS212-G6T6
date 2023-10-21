<div id="app" class="container mb-3">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="javascript:void(0);" onclick="gotoBrowseRoles()">
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
                        <a class="nav-link"href="javascript:void(0);" onclick="gotoAllRoleListings()">All Role Listings</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span id="selectedName">{{ $selectedName ?? 'Ji Eun Lee' }}</span>
                </button>   
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('hr', 'Bo Gum Park')">Bo Gum Park (HR Admin)</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('staff','Ji Eun Lee')">Ji Eun Lee (Regular Staff)</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('manager','Sejeong Kim')">Sejeong Kim (Hiring Manager)</a></li>
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

    const selectedValue = localStorage.getItem('selectedRole');

    if (selectedValue) {
        document.getElementById('selectedName').textContent = selectedValue;
    }

    function changeAccess(access, name) {
        
        localStorage.setItem('selectedRole', name);
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

        document.getElementById('selectedName').textContent = name;
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

    function gotoAllRoleListings() {

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



