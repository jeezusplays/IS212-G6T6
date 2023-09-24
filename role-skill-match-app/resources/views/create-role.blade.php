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

    <!-- select2 CDN -->
    <!-- Styles --> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  </head>

  <body>
    <div id="app">

      <!-- NAVBAR-->
        <div class="container">
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
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
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

      <!-- HEADER -->
      <div class="container my-4">
        
        <h2>{{$header}}</h2>
        <!-- <a class="btn btn-primary" href="" role="button">Link</a> -->
      </div>

      <!-- SEARCH -->


      <!-- FORM -->
      <div class="container">
            <!-- <form action="" method="post"> -->
            <form action="/create-role" method="POST">
              @csrf
                <div class="row">
                <!-- Text input (roleTitle) -->
                <div class="mb-3 col-lg-6">
                    <label for="Role_Name" class="form-label">Role Title</label>
                    <input required class="form-control" id="Role_Name" name="Role_Name" placeholder="Enter title" value="{{$Role_Name}}">
                </div>

                <!-- Select input (workArrangement) -->
                <div class="mb-3 col-lg-6">
                    <label for="Work_Arrangement" class="form-label">Work Arrangement</label>
                    <select required class="form-select" id="Work_Arrangement" name="Work_Arrangement">
                        <option value="" disabled selected>Select work arrangement</option>
                        @foreach ($workArrangementDDL as $work)
                          <option value = "{{ $work }}">
                            @if ($work == 1)
                              Full-time
                            @else
                              Part-time
                            @endif
                          </option>
                        @endforeach
                    </select>
                </div>

                <!-- Select input (department) -->
                <div class="mb-3 col-lg-6">
                    <label for="Department_ID" class="form-label">Select Department</label>
                    <select required class="form-select" id="Department_ID" name="Department_ID">
                    <option value="" disabled selected>Select department</option>
                        @foreach ($deptDDL as $dept)
                            <option value = "{{ $dept['Department_ID']}}">
                                {{$dept['Department']}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Select input (hiringManager) -->
                <div class="mb-3 col-lg-6">
                    <label for="Staff_ID" class="form-label">Select Hiring Manager</label>
                    <select required id="Staff_ID"  style="width:100%"  name="Staff_ID[]" class= "form-select select2" multiple  aria-placeholder="Select hiring manager(s)">
                        @foreach ($hiringManagerDDL as $hm)
                            <option value = "{{ $hm['Staff_ID'] }}">
                                {{$hm['Staff_FullName']}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Number input (vacancy) -->
                <div class="mb-3 col-lg-6">
                    <label for="Vacancy" class="form-label">Vacancy</label>
                    <input required type="number" max="5" min="1" class="form-control" id="Vacancy" name="Vacancy" placeholder="Enter vacancy" value = "{{$vacancy}}">
                </div>

                <!-- Date picker -->
                <div class="mb-3 col-lg-6">
                  <label for="Deadline" class="form-label">Deadline</label>
                  <input required type="date" class="form-control" id="Deadline" name="Deadline" placeholder="DD/MM/YYYY" value="{{$deadline}}">
                </div>

                <!-- Skills Required -->
                <div class="mb-3 col-lg-6">
                  <label for="Skills" class="form-label">Skills</label>
                  <br>
                  <select name="Skills[]" id="Skills" style="width:100%" multiple class= "select2" required>
                        @foreach ($skillsDDL as $skill)
                            <option value = "{{ $skill['skillID'] }}" >
                                {{$skill['skill']}}
                            </option>
                        @endforeach
                  </select>
                </div>
    
                <!-- Textarea (description) -->
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea class="form-control" id="Description" name="Description" rows="4" placeholder="Enter description" required value=" {{$description}} ">{{$description}}</textarea>
                </div>
            
                  <!-- Submit button -->
                  <div class="container">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <!-- <button type="submit" class="btn btn-outline-danger">Cancel</button> -->
                  </div>
                </div>

            </form>
      </div>

       <!-- Bootstrap Bundle -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>

    <script>
      $(document).ready(function() {
        $(".select2").select2({
          theme:'classic'
        });
      });
      </script>
</body>
</html>