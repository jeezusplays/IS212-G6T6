<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All-In-One (HR)</title>
    <!-- <link rel="icon" type="image/x-icon" href="../img/favicon.ico" /> -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />

    <style>
        #grey-box{
            background-color: rgb(223, 231, 242);
        }
    </style>
  </head>

  <body>
    <div class="container" id="app">

    <nav class="navbar navbar-expand-lg">
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
                    Staff Name (HR Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings">HR Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-staff">Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-manager">Manager</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-sm">
        <div class="row mt-5 mb-4">
            <div class="col-12 col-sm-8 text-start">
                <h1>Software Engineer</h1>
            </div>
            <div class="col-12 col-sm-4">
                <div class="d-flex justify-content-start justify-content-sm-end">
                    <button type="button" class="btn btn-success btn-md btn-lg">Apply Now</button>
                </div>
            </div>
        </div>
        
        <div class="row p-3 gy-2 gy-sm-0" id="grey-box">
            <div class="col-12 col-sm-4">
                Department: Information Technology 
            </div>
            <div class="col-12 col-sm-4">
                Work Arrangement: Part Time
            </div>
            <div class="col-12 col-sm-4">
                Location: Singapore
            </div>
        </div>

        <div class="row">
            <div class="col">

            </div>
        </div>
    </div>
    <script>
        document.getElementById()
    </script>
  </body>
</html>