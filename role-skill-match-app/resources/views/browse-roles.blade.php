@extends('layouts.app') {{-- Assuming you have a master layout --}}

@section('content')
<div class="container">
    <h1>Browse Job Roles</h1>

    {{-- Search Bar --}}
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Search by Job Title">
    </div>

    {{-- Filters Section --}}
    <div class="row mb-3">
        <div class="col-md-3">
            <select class="form-select">
                <option value="" selected>Filter by Department</option>
                {{-- Add department options dynamically --}}
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option value="" selected>Filter by Location</option>
                {{-- Add location options dynamically --}}
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option value="" selected>Filter by Skillsets</option>
                {{-- Add skillset options dynamically --}}
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary">Apply Filters</button>
        </div>
    </div>

    {{-- Job Listings --}}

</div>
@endsection
