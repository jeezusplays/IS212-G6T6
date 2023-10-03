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
      <nav
        class="navbar navbar-light navbar-expand-lg bg-body-secondary"
        style="background-color: #e3f2fd"
      >
        <div class="container-fluid">
          <!-- Shows account type -->
          <a class="navbar-brand" href="manageRoles.html"
            >All-In-One (HR)</a
          >

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- Navbar tabs for HR -->

              <!-- Manage Roles tab -->
              <li class="nav-item">
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="manageRoles.html"
                  >Manage Roles</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Manage Candidates</a>
              </li>
            </ul>

            <!-- Switches between account types -->
            <button
              class="btn btn-outline-primary"
              onclick=""
            >
              Switch to Staff View (for demo purpose)
            </button>
          </div>
        </div>
      </nav>

      <!-- HEADER -->
      <div class="container-fluid my-4">
        
        <h2>Update</h2>
        <a class="btn btn-primary" href="" role="button">Link</a>
      </div>

      <!-- SEARCH -->


      <!-- FORM -->
      @foreach ($roles as $role)
      <div class="container">
            <form class="needs-validation" novalidate  id="form" action="/updateRole" method="post">
                @csrf
                <!-- Job status -->
                <input type="hidden" id="Status" name="Status" value="{{$role['status']}}"> <!-- change to status once backend done -->
                <input type="hidden" id="listingID" name="listingID" value="{{ $role['listingID'] }}">

                <div class="row">
                <!-- Text input (jobTitle) -->
                <div class="mb-3 col-lg-6">
                    <label for="jobTitle" class="form-label">Role Title</label>
                    <select required class="form-select" style="width:100%" id="roleTitle" name="roleTitle">
                        @foreach ($rolesDDL as $roleTitle)
                            <option value = "{{ $roleTitle -> role_id}}" {{ $roleTitle -> role == $role['role'] ? 'selected' : '' }}>
                                {{$roleTitle -> role }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Role Title cannot be empty</div>
                </div>

                <!-- Select input (workArrangement) -->
                <div class="mb-3 col-lg-6">
                    <label for="workArrangement" class="form-label">Work Arrangement</label>
                    <select required class="form-select" id="workArrangement" name="workArrangement">
                        @if ($role['work_arrangement'] == '1')
                        <option selected value='1'>Part Time</option>
                        @else
                        <option value='1'>Part Time</option>
                        @endif
                        @if ($role['work_arrangement'] == '2')
                        <option selected value ='2'>Full Time</option>
                        @else
                        <option value='2'>Full Time</option>
                        @endif
                    </select>
                    <div class="invalid-feedback">Work Arrangement cannot be empty</div>
                </div>

                <!-- Select input (department) -->
                <div class="mb-3 col-lg-6">
                    <label for="department" class="form-label">Select Department</label>
                    <select required class="form-select" id="department" name="department">
                        @foreach ($departments as $dept)
                            <option value = "{{ $dept -> department_id}}" {{ $dept -> department == $role['department'] ? 'selected' : '' }}>
                                {{$dept -> department }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Department cannot be empty</div>
                </div>

                <!-- Select input (hiringManager) -->
                <div class="mb-3 col-lg-6">
                    <label for="hiringManager" class="form-label">Select Hiring Manager</label>
                    <select required id="hiringManager"  style="width:100%"  name="hiringManager[]" class= "form-select select2" multiple>
                        @foreach ($hiringManagers as $hm)
                            <option value = "{{ $hm->staff_id}}" {{ in_array($hm->hiring_manager_name, $role['staff_name']) ? 'selected' : '' }}>
                                {{$hm->hiring_manager_name}}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">You must select at least 1 hiring manager</div>
                </div>

                <!-- Number input (vacancy) -->
                <div class="mb-3 col-lg-6">
                    <label for="vacancy" class="form-label">Vacancy</label>
                    <input required type="number" min="1" max="5" class="form-control" id="vacancy" name="vacancy" placeholder="Enter vacancy" value = "{{$role['vacancy']}}">
                    <div class="invalid-feedback">You must have between 1 and 5 vacancies</div>
                </div>

                <!-- Date picker -->
                <div class="mb-3 col-lg-6">
                  <label for="deadline" class="form-label">Deadline</label>
                  <input required type="date" class="form-control" id="deadline" name="deadline" placeholder="DD/MM/YYYY" value="{{$role['deadline']}}">
                  <div class="invalid-feedback">Deadline date cannot be in the past</div>
                </div>

                <!-- Country ID -->
                <div class="mb-3 col-lg-6">
                    <label for="Country_ID" class="form-label">Country</label>
                    <select required  class="form-select" id="Country_ID" name="Country_ID">
                        <option value="" disabled selected>Select country</option>
                          @foreach ($countries as $country)
                          <option value = "{{ $country -> country_id }}" {{ $country-> country_id == $role['country_id'] ? 'selected' : '' }}>
                                {{$country -> country}}
                          </option>
                          @endforeach
                    </select>
                    <div class="invalid-feedback">Country cannot be empty</div>
                </div>

                <!-- Skills Required -->
                <div class="mb-3 col-lg-6">
                  <label for="skills" class="form-label">Skills</label>
                  <br>
                  <select required id="skills" style="width:100%" multiple name="skills[]" class= "form-select select2" >
                        @foreach ($skills as $skill)
                            <option value = "{{ $skill -> skill_id }}" {{ in_array($skill -> skill, $role['skills']) ? 'selected' : '' }}>
                                {{$skill -> skill}}
                            </option>
                        @endforeach
                  </select>
                  <div class="invalid-feedback">You must select at least 1 skill.</div>
                </div>
    
                <!-- Textarea (description) -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea required class="form-control" id="description" name="description" rows="4" placeholder="Enter description">{{$role['description']}}</textarea>
                    <div class="invalid-feedback">Description cannot be empty</div>
                </div>

                  <!-- Submit button -->
                  <div class="container">
                    <button class="btn btn-primary me-2" id="submit">Save</button>
                    <!-- <button type="submit" class="btn btn-outline-danger">Cancel</button> -->
                  </div>
                </div>

            </form>
      </div>
      @endforeach
       <!-- Bootstrap Bundle -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>

      <!-- sweetalert -->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
    
      $(document).ready(function() {
        $(".select2").select2({
          theme:'classic'
        });
      });

      //Alert for successful role creation
      $("#submit").click(function() {
        var roleName = $("#roleTitle").val();
        var workArrangement = $("#workArrangement").val();
        var department = $("#department").val();
        var vacancy = $("#vacancy").val();
        var deadline = $("#deadline").val();
        var country = $("#Country_ID").val();
        var skills = $("#skills").val();
        var description = $("#description").val();
        var hiringManager = $("#hiringManager").val();

        var selectedDate = new Date(deadline); // Convert the input value to a Date object
        var currentDate = new Date(); // Get the current date

        if (roleName == '' || workArrangement == '' || department == '' || vacancy == '' || deadline == '' || country == null || skills.length == 0|| description == '' || hiringManager.length == 0) {
          swal({
            title: "All Fields Required",
            text: "Please fill in all fields before submitting",
            icon: "error",
            button: "Back to form",
          });
        } 
        else if (selectedDate.getDate() < currentDate.getDate())
          swal({
            title: "Deadline Field is Wrong",
            text: "Deadline date cannot be in the past" + currentDate,
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
      document.getElementById("deadline").setAttribute("min", minDate);
      </script>
</body>
</html>