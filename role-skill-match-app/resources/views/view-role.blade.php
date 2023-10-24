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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <body>
        
    <div class="container-sm">
    {{-- Top Menu Bar --}} <!--  notw orking -->
    @include('top-menu-bar')

        @if ($isRoleValid)
            @foreach ($roles as $role)
            <div class="row mt-5 mb-4">
                <div class="col-12 col-sm-8 text-start">
                    <h1>{{$role['role']}} ({{ $role['work_arrangement'] == 1 ? "Part Time" : "Full Time"}})</h1>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="d-flex justify-content-start justify-content-sm-end">
                        <button type="button" class="btn btn-success btn-md btn-lg">Apply Now</button>
                    </div>
                </div>
            </div>
            
            <div class="row p-3 gy-2 gy-sm-0" id="grey-box">
                <div class="col-12 col-sm-4">
                    <b>Department</b> {{$role['department']}}
                </div>
                <div class="col-12 col-sm-4">
                    <b>Country</b> {{$role['country']}}
                </div>
                <div class="col-12 col-sm-4">
                    <b>Vacancy</b> {{$role['vacancy']}}
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <h3>Job Description</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    {{$role['description']}}
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <h3>Skills</h3>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    @foreach ($role['skills'] as $skill)
                        <button class="skill">{{$skill}}</button>
                    @endforeach
                </div>
            </div>

            <div class="row mt-5">
                <div class="col text-danger">
                    This listing closes on {{$role['deadline']}}
                </div>
            </div>
            @endforeach
        @else
            <div class="alert alert-danger">
                Invalid Role
            </div>
        @endif
    </div>

    </body>
</html>
