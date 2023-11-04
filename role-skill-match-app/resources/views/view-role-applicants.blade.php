<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $roles[0]['role'] }} Applicants</title>
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

    <style>
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

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon-32x32.png') }}">
</head>

<body>
    {{-- Top Menu Bar --}}
    @include('top-menu-bar')

    <div class="container-sm">
        @if ($isRoleValid)
            @foreach ($roles as $role)
                <div class="row mt-5 mb-4">
                    <div class="col-12 col-sm-8 text-start">
                        <h1>Applicants for <i>{{ $role['role'] }}</i> role</h1>
                    </div>
                </div>

                <div class = "container" id ="grey-box">

                </div>
                <div class="row p-3 gy-2 gy-sm-0" id="grey-box">
                        <div class="col-12 col-sm-4">
                            <b>Department:</b> {{ $role['department'] }}
                        </div>

                        <div class="col-12 col-sm-4">
                            <b>Work Arrangement:</b>
                            @if ($role['work_arrangement'] == 1)
                                Part Time
                            @else
                                Full Time
                            @endif
                        </div>
                        <div class="col-12 col-sm-4">
                            <b>Country:</b> {{ $role['country'] }}
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <b>Vacancy: </b>{{ $role['vacancy'] }} positions
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col text-danger">
                                This listing closes on {{ $role['deadline'] }}
                            </div>
                        </div>

                </div>

                        <div class="mt-4">
                            <h4>Role Skills</h4>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                @foreach ($role['skills'] as $skill)
                                    <button class="skill">{{ $skill }}</button>
                                @endforeach
                            </div>
                        </div>



                {{-- Create a bootstrap table containing columns 'Name, 'Application Date', 'Skillset', 'Status', 'Email' --}}
                <div class="row mt-5">
                    <h4>Applicants</h4>
                    <div class="col">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class = "align-middle" style = "background-color: rgb(223, 231, 242);">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Application Date</th>
                                    <th scope="col">Skillset & Proficiency</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Skillset Match %</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($role['applicants']) === 0)
                                    <tr>
                                        <td colspan="6" style="text-align: center;">There are no applicants for this role listing yet.
                                        </td>
                                    </tr>
                                @else
                                @foreach ($role['applicants'] as $applicant)
                                    <tr>
                                        <td>{{ $applicant['staff_name'] }}</td>
                                        <td>{{ $applicant['application_date'] }}</td>
                                        <td>
                                            {{-- Iterate through both $applicant['skillset'] and $applicant['proficiency'] together at same index --}}
                                            @foreach ($applicant['skillset'] as $index => $skill)
                                                <button class="skill" style ="text-align: left;">{{ $skill }}
                                                    ({{ $applicant['proficiency'][$index] }})</button>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{-- Status: 1 = Applied, 2 = HR Received, 3 = Interview scheduled, 
                                                4 = accept , 5 = rejected, 6 = withdrawn
                                            --}}
                                            @if ($applicant['status'] == 1)
                                                Applied
                                            @elseif ($applicant['status'] == 2)
                                                HR Received
                                            @elseif ($applicant['status'] == 3)
                                                Interview scheduled
                                            @elseif ($applicant['status'] == 4)
                                                Accepted
                                            @elseif ($applicant['status'] == 5)
                                                Rejected
                                            @elseif ($applicant['status'] == 6)
                                                Withdrawn
                                            @endif
                                        </td>
                                        {{-- create a td with hyperlinked field --}}
                                        <td><a href="mailto:{{ $applicant['email'] }}">{{ $applicant['email'] }}</a>
                                        </td>
                                        <td>50% - Placeholder</td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
            @endforeach
        @else
            <div class="alert alert-danger">
                Notice: Role has been closed! 
                Please reopen the role listing to view role applicants.
            </div>
        @endif
    </div>

</body>

</html>
