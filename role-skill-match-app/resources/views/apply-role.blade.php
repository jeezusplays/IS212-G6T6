<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Role</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

        .skill{
            background-color: rgb(223, 231, 242);
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 16px;
        }
    </style>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon-32x32.png') }}">
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
                    Li Ji Eun (Staff)
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

                    <h1>Financial Analyst</h1>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="d-flex justify-content-start justify-content-sm-end">
                    <form action="{{route('apply-role')}}" id="form" method="POST">
                        @csrf
                        <input type="hidden" id="listing_id" name="listing_id" value="1">
                        <input type="hidden" id="staff_id" name="staff_id" value="1">
                        <input type="hidden" id="application_date" name="application_date">
                        <button type="submit" id="submit" role="button" class="btn btn-success btn-md btn-lg">Apply Now</button>
                    </form>
                    </div>
                </div>
            </div>

        <!-- Hard coded staff_id and role_id for now -->

        
        <div class="row">
            
            <div class="row p-3 gy-2 gy-sm-0" id="grey-box">

                <div class="col-12 col-sm-4">
                    <b>Department</b> Finance
                </div>
                <div class="col-12 col-sm-4">
                    <b>Work Arrangement</b> 
                    Full Time
                </div>
                <div class="col-12 col-sm-4">
                    <b>Country</b> Singapore
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <h3>Job Description</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    Test Description
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <h3>Skills</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                        <button class="skill">Capital Management</button>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col">
                    <h3>Vacancy</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    1 positions
                </div>
            </div>

            <div class="row mt-5">
                <div class="col text-danger">
                    This listing closes on 2021-10-31
                </div>
            </div>
    </div>

        <!-- Bootstrap Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    
    <script>
        // set application date to today's date
        const today = new Date(); 
        document.getElementById('application_date').value =
        today.getFullYear() + "-" + 
        (today.getMonth()+1) + "-" +
        today.getDate();

        // render alerts depending on backend response
        @if(session('success'))
        swal({
          title: "Application successful",
          text: "{{session('success')}}",
          icon: "success",
        });

        @elseif(session('error')){
        swal({
          title: "Application unsuccessful",
          text: "{{session('error')}}",
          icon: "error",
        });
        };
        @endif
        
    </script>        
    <script>
        // listing_id and staff_id are passed from the view-role backend(?), hardcoded for now

        // bind Message from backend to JS variable
        // Trigger alerts
        // $("#submit").click(function() {

        // //send listing_id and staff_id to ApplicationController
        // $.ajax({
        //     url: 'route("apply-role")',
        //     data: {
        //         Role_ID: listing_id,
        //         Staff_ID: staff_id  
        //     },
        //     success: function(response) {
        //         console.log(response);
        //         var outcomeMessage = response; //assuming this is the message
        //         }
        //     });

        //   if (outcomeMessage == "Application created successfully") {
        //     swal({
        //     title: "succcess",
        //     text: outcomeMessage,
        //     icon: "success",
        //     button: "Back",
        //   })
        // }
        //   else {
        //     swal({
        //     title: "error",
        //     text: outcomeMessage,
        //     icon: "error",
        //     button: "Back",
        //   });
        //   }
        // });
    </script>

    </body>
</html>
