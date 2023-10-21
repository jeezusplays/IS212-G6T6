<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Skill Proficiency</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/x-icon">


</head>
<style>
    .centerAll {
        text-align: center;
        align-items: center;
        justify-content: center;
        place-items: center;
        vertical-align: middle;
        /* line-height: 0px; */
        margin: auto;
        /* display: flex;
        display: block; */
        /* position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); */
        /* Bootstrap */
        /* <div class = "mx-auto">*/
        /* <div class = "row-justify-content-center/end/around/between"> */
        /* <p class = "text-center"> */
    }

    #grey-box {
        background-color: rgb(223, 231, 242);
    }

    .skill {
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

<body>

    <div class="container" id="app">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="http://localhost:8000/role-listings">
                <img src="{{ asset('favicon-32x32.png') }}" alt="Company Logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="http://localhost:8000/browse-roles">Browse Role Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/my-applications">View Applications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/indicate-skill-proficiency/staffID=1">My Skill
                            Proficiency</a>
                    </li>

                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $staff_skillset_proficiency[0]['staff_name'] }} (Staff)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings">HR Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/browse-roles">Staff</a></li>
                    <li><a class="dropdown-item" href="http://localhost:8000/role-listings-manager">Manager</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container mt-5">
        <h2>My Skills and Proficiency</h2>
        <h5 class = "my-3">
            <i>
                Assess and indicate your proficiency levels in various work-related skills.
            </i>
        </h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Skill</th>
                    <th>Proficiency</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staff_skillset_proficiency[0]['staff_skills'] as $skill)
                    <tr>
                        <td>
                            <button class="skill" style ="text-align: left;">{{ $skill['skill_name'] }}</button>
                        </td>
                        <td class = "centerAll">
                            <select class="form-select"
                                id ="skill_{{ $skill['skill_name'] }}_{{ $skill['proficiency_id'] }}"
                                aria-label="Default select example">
                                {{-- Make default selected value the current proficiency id --}}
                                @if ($skill['proficiency_id'] == 1)
                                    <option value="{{ $skill['proficiency_id'] }}" id= "{{ $skill['proficiency_id'] }}_1" selected >Beginner</option>
                                    <option value="2" id= "{{ $skill['proficiency_id'] }}_2">Intermediate</option>
                                    <option value="3" id= "{{ $skill['proficiency_id'] }}_3">Expert</option>
                                @elseif ($skill['proficiency_id'] == 2)
                                    <option value="{{ $skill['proficiency_id'] }}" id= "{{ $skill['proficiency_id'] }}_1">Beginner</option>
                                    <option value="2" id= "{{ $skill['proficiency_id'] }}_2" selected >Intermediate</option>
                                    <option value="3" id= "{{ $skill['proficiency_id'] }}_3">Expert</option>
                                @elseif ($skill['proficiency_id'] == 3)
                                    Currently Set Proficiency: Expert
                                    <option value="1" id= "{{ $skill['proficiency_id'] }}_1">Beginner</option>
                                    <option value="2" id= "{{ $skill['proficiency_id'] }}_2">Intermediate</option>
                                    <option value="{{ $skill['proficiency_id'] }}" id= "{{ $skill['proficiency_id'] }}_3" selected >Expert</option>
                                @endif

                            </select>
                        </td>
                    <tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-grid gap-2 col-2 mx-auto">
            <button class="btn btn-success" type="button">Save Changes</button>
        </div>

</body>
<!-- Include Bootstrap JS and jQuery -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const saveChangesButton = document.querySelector('.btn-success');

        saveChangesButton.addEventListener('click', function() {
            const proficiencyData = [];
            const proficiencyDropdowns = document.querySelectorAll('select.form-select');

            proficiencyDropdowns.forEach((dropdown) => {
                const proficiencyId = dropdown.id.split('_').pop(); // Extract proficiency_id
                const selectedValue = dropdown.value; // Selected proficiency value

                proficiencyData.push({
                    proficiency_id: proficiencyId,
                    value: selectedValue,
                });
            });

            // Send proficiency data to the controller via an AJAX request
            axios.post('/update-skill-proficiency', {
                    data: proficiencyData,
                })
                .then((response) => {
                    // Handle the response from the controller (e.g., display a success message)
                    swal("Success!", response.data.message, "success");
                })
                .catch((error) => {
                    // Handle errors, if any
                    console.error(error);
                    swal("Error", "Failed to update skillset proficiency", "error");
                });
        });
    });
</script>

</html>

</html>
