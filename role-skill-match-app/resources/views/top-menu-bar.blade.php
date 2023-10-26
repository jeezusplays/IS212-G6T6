<div id="app" class="container mb-3">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="javascript:void(0);" onclick="gotoHomePage()">
                <img src="{{ asset('favicon-32x32.png') }}" alt="Company Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                @if (Str::contains(request()->url(), ['/staff_id=1']))
                    <li class="nav-item active">
                        <a class="nav-link" href="javascript:void(0);" onclick="gotoBrowseRoles()">Browse Role Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/my-applications">View My Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="javascript:void(0);" onclick="gotoMySkills()">My Skills</a>
                    </li>
                @endif
                    @if (Str::contains(request()->url(), ['/staff_id=6', '/staff_id=5','/staff_id=8']))
                    <li class="nav-item">
                        <a class="nav-link"href="javascript:void(0);" onclick="gotoCreateRole()">Create Role Listing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="javascript:void(0);" onclick="gotoAllRoleListings()">Manage Role Listings</a>
                    </li>   
                    @endif
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span id="selectedName">{{ $selectedName ?? 'Ji Eun Lee' }}</span>
                </button>   
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('staff_id=5', 'Bo Gum Park')">Bo Gum Park (HR)</a></li>
                
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('staff_id=1','Ji Eun Lee')">Ji Eun Lee (User)</a></li>
    
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('staff_id=6','Sejeong Kim')">Sejeong Kim (Hiring Manager)</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="changeAccess('staff_id=8','Sohee Han')">Sohee Han (Admin)</a></li>
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
        if (page.includes('indicate-skill-proficiency')) {
            // Check if the page includes "indicate-skill-proficiency"
            let newPath;
            if (access === "staff_id=5") {
                newPath = 'staff_id=5/indicate-skill-proficiency';
            } else if (access === "staff_id=6") {
                newPath = 'staff_id=6/indicate-skill-proficiency';
            } else if (access === "staff_id=1") {
                newPath = 'staff_id=1/indicate-skill-proficiency';
            } else if (access === "staff_id=8") {
                newPath = 'staff_id=8/indicate-skill-proficiency';
            }
            const newUrl = `${window.location.origin}/${newPath}`;

            window.location.href = newUrl;

        } else if (page.includes('create-role') || page.includes('role-listings')) {
            if (access.includes('staff_id=1')){
                window.location.href = `${window.location.origin}/${access}/browse-roles`;
            }
            else {
                newUrl = `${window.location.origin}/${access}/${page.join('/')}`;
                window.location.href = newUrl;
            }
            
            //window.location.href = newUrl;

        } else if (segments[1].includes('staff_id=1')){
            newUrl = `${window.location.origin}/${access}/create-role`;
            window.location.href = newUrl;

        } else {
            // Construct the new URL with the selected access and the current page
            const newUrl = `${window.location.origin}/${access}/${page.join('/')}`;
            // Navigate to the new URL
            window.location.href = newUrl;
        }

        document.getElementById('selectedName').textContent = name;
    }

    function gotoHomePage() {

        const currentUrl = window.location.href;

        // Extract the part of the URL after the domain, which includes the page
        const urlSegments = currentUrl.split(window.location.origin)[1];

        // Split the URL segments by '/'
        const segments = urlSegments.split('/');  
        access=segments[1];
        console.log(access);

        // Construct the new URL with the selected access and the current page
        if (access.includes('staff_id=1')){
            newUrl = `${window.location.origin}/${access}/browse-roles`;
        } else {
            newUrl = `${window.location.origin}/${access}/create-role`; 
        }
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

        function gotoMySkills() {

            const currentUrl = window.location.href;

            // Extract the part of the URL after the domain, which includes the page
            const urlSegments = currentUrl.split(window.location.origin)[1];
            
            // Split the URL segments by '/'
            const segments = urlSegments.split('/');  
            access=segments[1]

            // Initialize staffID with a default value
            let staffID = 1;

            // Check the value of the access variable and set staffID accordingly
        
            const newUrl = `${window.location.origin}/${access}/indicate-skill-proficiency`;

            
            // Navigate to the new URL
            window.location.href = newUrl;
        }
    </script>



