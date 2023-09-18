<!DOCTYPE html>
<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/x-icon">
</head>

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<body>
<div id = "app" class="container">
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
        <div class="ml-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Current User (HR Staff)
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- Dropdown menu options --}}
                </div>
            </div>
        </div>
    </nav>

    {{-- Role Listings --}}
    <h1>Role Listings</h1>
    {{-- Add a search form here --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Total Applications</th>
                <th>Creation Date</th>
                <th>Listed By</th>
                <th>Status</th>
            </tr>
        </thead>
        {{-- Loop through your role data and display it here --}}
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role['job_title'] }}</td>
                <td>{{ $role['total_applications'] }}</td>
                <td>{{ $role['creation_date'] }}</td>
                <td>{{ $role['listed_by'] }}</td>
                <td>
                    @if($role['status'] === 'Open')
                        <span class="badge badge-success">Open</span>
                    @else
                        <span class="badge badge-secondary">Closed</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
