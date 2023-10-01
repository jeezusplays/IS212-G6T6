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

      <!-- FORM -->
      <div class="container">
            <form class="needs-validation" novalidate action="/create-role" method="POST">

                @csrf
                <div class="row">

                <!-- Job status & Creator ID -->
                <input type="hidden" id="Status" name="Status" value="{{$status}}">
                <input type="hidden" id="Created_By" name="Created_By" value="{{ $Staff_ID }}">

                <!-- Text input (roleTitle) -->
                <div class="mb-3 col-lg-6">
                    <label for="Role_Name" class="form-label">Role Title</label>
                    <input required class="form-control" id="Role_Name" name="Role_Name" placeholder="Enter title" value="{{$Role_Name}}">
                    <div class="invalid-feedback">Role Name cannot be empty</div>
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
                    <div class="invalid-feedback">Work Arrangement cannot be empty</div>
                </div>

                <!-- Select input (department) -->
                <div class="mb-3 col-lg-6">
                    <label for="Department_ID" class="form-label">Select Department</label>
                    <select required  class="form-select" id="Department_ID" name="Department_ID">
                    <option value="" disabled selected>Select department</option>
                        @foreach ($deptDDL as $dept)
                            <option value = "{{ $dept }}">
                            @if ($dept == 1)
                              Sales

                            @elseif ($dept == 2)
                              Consultancy

                            @elseif ($dept == 3)
                              System Solutioning

                            @elseif ($dept == 4)
                              Engineering

                            @elseif ($dept == 5)
                              HR and Admin

                            @elseif ($dept == 6)
                              Finance

                            @else
                              IT
                            @endif
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Department cannot be empty</div>
                </div>

                <!-- Select input (hiringManager) -->
                <div class="mb-3 col-lg-6">
                    <label for="Staff_ID" class="form-label">Select Hiring Manager</label>
                    <select required  id="Staff_ID"  style="width:100%"  name="Staff_ID[]" class= "form-select select2" multiple  aria-placeholder="Select hiring manager(s)">
                        @foreach ($hiringManagerDDL as $hm)
                            <option value = "{{ $hm['Staff_ID'] }}">
                                {{$hm['Staff_FullName']}}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">You must select at least 1 hiring manager</div>
                </div>

                <!-- Number input (vacancy) -->
                <div class="mb-3 col-lg-6">
                    <label for="Vacancy" class="form-label">Vacancy</label>
                    <input type="number" max="5" min="1" class="form-control" id="Vacancy" name="Vacancy" placeholder="Enter vacancy" value = "{{$vacancy}}">
                    <div class="invalid-feedback">You must have between 1 and 5 vacancies.</div>
                </div>

                <!-- Date picker -->
                <div class="mb-3 col-lg-6">
                  <label for="Deadline" class="form-label">Deadline</label>
                  <input type="date" required class="form-control" id="Deadline" name="Deadline" placeholder="DD/MM/YYYY" value="{{$deadline}}">
                  <div class="invalid-feedback">You must select a date later than today.</div>
                </div>
                

                <!-- Country ID -->
                <div class="mb-3 col-lg-6">
                    <label for="Country_ID" class="form-label">Country</label>
                    <select required  class="form-select" id="Country_ID" name="Country_ID">
                        <option value="" disabled selected>Select country</option>
                        @foreach ($countryID_DDL as $countryID)
                          <option value = "{{ $countryID }}">
                            @if ($countryID == 1)
                              Singapore

                            @elseif ($countryID == 2)
                              Malaysia

                            @elseif ($countryID == 3)
                              Indonesia

                            @elseif ($countryID == 4)
                              Vietnam
                            
                            @else
                              Hong Kong
                            @endif
                          </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Country cannot be empty</div>
                </div>

                <!-- Skills Required -->
                <div class="mb-3 col-lg-6">
                  <label for="Skills" class="form-label">Skills</label>
                  <br>
                  <select required name="Skills[]" id="Skills" style="width:100%" multiple class= "select2">
                        @foreach ($skillsDDL as $skill)
                            <option value = "{{ $skill }}" >
                              @if ($skill == 1)
                              Capital Management

                              @elseif ($skill == 2)
                              Capital Expenditure and Investment Evaluation

                              @elseif ($skill == 3)
                              People Management

                              @elseif ($skill == 4)
                              Stakeholder Management
                              
                              @elseif ($skill == 5)
                              Strategy Implementation

                              @elseif ($skill == 6)
                              Architecture Design

                              @elseif ($skill == 7)
                              Equipment Maintenance and Housekeeping

                              @elseif ($skill == 8)
                              Project Risk Management

                              @elseif ($skill == 9)
                              Employer Branding

                              @elseif ($skill == 10)
                              Operational Excellence
                              
                              @elseif ($skill == 11)
                              Market Profiling

                              @elseif ($skill == 12)
                              Financial Reporting

                              @elseif ($skill == 13)
                              Cyber Security

                              @else
                              Agile Software Development
                              @endif
                            </option>
                        @endforeach
                  </select>
                  <div class="invalid-feedback">You must select at least 1 skill.</div>
                </div>
    
                <!-- Textarea (description) -->
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea required class="form-control" id="Description" name="Description" rows="4" placeholder="Enter description"value=" {{$description}} ">{{$description}}</textarea>
                    <div class="invalid-feedback">Description cannot be empty</div>
                </div>
            
                  <!-- Submit button -->
                  <div class="container">
                    <button type="submit" id="submit" class="btn btn-primary me-2">Create Role</button>
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

        <!-- sweetalert -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
      // Select 2 JS
      $(document).ready(function() {
        $(".select2").select2({
          theme:'classic'
        });
      });



      //Alert for successful role creation
      $("#submit").click(function() {
        var roleName = $("#Role_Name").val();
        var workArrangement = $("#Work_Arrangement").val();
        var department = $("#Department_ID").val();
        var vacancy = $("#Vacancy").val();
        var deadline = $("#Deadline").val();
        var country = $("#Country_ID").val();
        var skills = $("#Skills").val();
        var description = $("#Description").val();
        var hiringManager = $("#Staff_ID").val();
        
        if (roleName == '' || workArrangement == '' || department == '' || vacancy == '' || deadline == '' || country == null || skills.length == 0|| description == '' || hiringManager.length == 0) {
          swal({
            title: "All Fields Required",
            text: "Please fill in all fields before submitting",
            icon: "error",
            button: "Back to form",
          });
        } 
        else if (selectedDate < currentDate)
          swal({
            title: "Deadline Field is Wrong",
            text: "Your deadline date cannot be in the past",
            icon: "error",
            button: "Back to form",
          })
        else if (vacancy > 5 || vacancy <1){
          swal({
            title: "Vacancy Field is Wrong",
            text: "The number of vacancy cannot be more than 5 or less than 1",
            icon: "error",
            button: "Back to form",
          })
        }
        else {
          swal({
            title: "Role Created",
            text: "Role has been created successfully",
            icon: "success",
            button: "Back",
          });
        }

      });



      // Form validation
      var forms = document.querySelectorAll('.needs-validation');
      Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });

      // Set datepicker min date to today
      var today = new Date();
      var todayDate = today.getDate();
      if (todayDate < 10) {
        todayDate = "0" + todayDate;
      }
      var todayMonth = today.getMonth()+1;
      if (todayMonth < 10) {
        todayMonth = "0" + todayMonth;
      }
      var todayYear = today.getFullYear();
      var minDate = todayYear + "-" + todayMonth + "-" + todayDate;
      console.log(minDate);
      document.getElementById("Deadline").setAttribute("min", minDate);

      //show Success card
      // function successCard() {
      //   var successCard = document.getElementById("success-card");
      //   successCard.style.display = "block";
      // }


      </script>

</body>
</html>