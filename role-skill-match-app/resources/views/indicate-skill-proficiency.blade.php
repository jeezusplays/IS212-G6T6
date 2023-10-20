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
    .centerAll{
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
                                <a class="nav-link" href="http://localhost:8000/indicate-skill-proficiency">My Skill Proficiency</a>
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
                        <li><a class="dropdown-item" href="http://localhost:8000/browse-roles">Staff</a></li>
                        <li><a class="dropdown-item" href="http://localhost:8000/role-listings-manager">Manager</a></li>
                    </ul>
                </div>
            </nav>
        </div>

<div class="container mt-5">
    <h2>My Skills and Proficiency</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Skill</th>
                <th>Proficiency</th>
            </tr>
        </thead>
        <tbody>

            <tr>

                <td><button class="skill" style ="text-align: left;">Capital Management</button></td>
                {{-- Dropdown box with 3 selections: Beginner, Intermediate, Expert--}}
                <td class = "centerAll">
                    <select class="form-select" id ="skill_1" aria-label="Default select example">
                        <option selected value ="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Expert</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><button class="skill" style ="text-align: left;">Capital Expenditure and Investment Evaluation</button></td>
                <td class = "centerAll">
                    <select class="form-select" id ="skill_2" aria-label="Default select example">
                        <option selected value ="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Expert</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><button class="skill" style ="text-align: left;">People Management</button></td>
                <td class = "centerAll">
                    <select class="form-select" id ="skill_3" aria-label="Default select example">
                        <option selected value ="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Expert</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><button class="skill" style ="text-align: left;">Stakeholder Management</button></td>
                <td class = "centerAll">
                    <select class="form-select" id ="skill_4" aria-label="Default select example">
                        <option selected value ="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Expert</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><button class="skill" style ="text-align: left;">Strategy Implementation</button></td>
                <td class = "centerAll">
                    <select class="form-select" id ="skill_5" aria-label="Default select example">
                        <option selected value ="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Expert</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="d-grid gap-2 col-2 mx-auto">
        <button class="btn btn-success" type="button">Save Changes</button>
</div>

<!-- Include Bootstrap JS and jQuery -->
</body>
<!-- Include Bootstrap JS and jQuery -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const saveChangesButton = document.querySelector('.btn-success');

        saveChangesButton.addEventListener('click', function () {
            // store the value of the selected option in a variable

            swal("Success!", "Skillset proficiency changes have been saved.", "success");
        });
    });
</script>
</html>

</html>
