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
        Browse Roles
    </Title>
</head>

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])


{{-- Top Menu Bar --}}
<div id="app" class="container">
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
    <h1>Browse Job Roles</h1>

    {{-- Search Bar --}}
    <div class="mb-3">
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search by Job Title" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    {{-- Sample Job Listing Card --}}
    <div class="row">
        <div class="col-md-3 my-3">
            <!-- Filters Section (3 columns) -->
            <select class="form-select mb-3">
                <option value="" selected>Filter by Department</option>
                {{-- Add department options dynamically --}}
            </select>
            <select class="form-select mb-3">
                <option value="" selected>Filter by Location</option>
                {{-- Add location options dynamically --}}
            </select>
            <select class="form-select mb-3">
                <option value="" selected>Filter by Skillsets</option>
                {{-- Add skillset options dynamically --}}
            </select>
            <button class="btn btn-primary w-100">Apply Filters</button>
        </div>

        <div class="col-md-9">
            <!-- Sample Job Listing Card -->
            @foreach ($roles as $role)
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $role['role'] }} ({{ $role['work_arrangement'] }})</h5>
                    <p class="card-text">Department: {{ $role['department'] }}</p>
                    <p class="card-text">Location: {{ $role['country'] }}</p>
                    <p class="card-text">Posted: {{ $role['created_at'] }}</p>
                    <p class="card-text">Skills:
                        @foreach ($role['skills'] as $index => $skill)
                            {{ $skill }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </p>
                    <p class="card-text"><i>Application Closes on: 10 Oct 2023 </i></p>
                    <p class="card-text">Status: {{ $role['status'] }}</p>
                    <p class="card-text">Applicants: {{ $role['total_applications'] }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>