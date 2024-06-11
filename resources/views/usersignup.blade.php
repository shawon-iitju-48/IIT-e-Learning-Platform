<!doctype html>
<html lang="en">

<head>
    <title>Sign Up to CRMS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>

<body>
    <div class="container">
        <header>
            <div class="navigation">
                <div class="row ">
                    <div class="col-8">
                        <a href="">Home</a>
                        <a href="">About</a>
                        <a href="">Contact</a>
                        <a href="">Notices</a>

                    </div>
                    <div class="col-4 ">
                        <a href="{{ url('/') }}/login">Sign in</a>
                        <a href="{{ url('/') }}/signup">Register</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="shuru">
            <div class="row ">
                <div class="col-8">
                    <div class="headline">
                        <b style="font-size:2rem;">CRMS</b>
                        <b>Sign up to your account</b>
                    </div>
                    <form action="{{ url('/') }}/signup/data" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="mb-3">
                                <label for="" class="form-label">First Name:</label>
                                <input type="text" class="form-control" value="{{ old('fname') }}" name="fname"
                                    id="" aria-describedby="fnameHelpId" placeholder="Enter your first name."
                                    autocomplete="off" required>
                                <span class="text-danger">
                                    @error('fname')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" value="{{ old('lname') }}" name="lname"
                                    id="" aria-describedby="lnameHelpId" placeholder="Enter your last name."
                                    autocomplete="off" required>
                                <span class="text-danger">
                                    @error('lname')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                        </div>
                        <div class="card">
                            <div class="mb-3">
                                <label for="" class="form-label">Email:</label>
                                <input type="text" class="form-control" value="{{ old('email') }}" name="email"
                                    id="" aria-describedby="emailHelpId" placeholder="Enter your email."
                                    autocomplete="off" required>
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Registration No:</label>
                                <input type="text" class="form-control" value="{{ old('u_id') }}" name="u_id"
                                    id="" aria-describedby="uidHelpId"
                                    placeholder="Enter your registration number." autocomplete="off" required>
                                <span class="text-danger">
                                    @error('u_id')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                        </div>
                        <div class="card">
                            <div class="mb-3">
                                <label for="" class="form-label">Password:</label>
                                <input type="password" class="form-control" name="password" id=""
                                    aria-describedby="passwordHelpId" placeholder="Enter your password."
                                    autocomplete="off" required>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" name="cpassword" id=""
                                    aria-describedby="confHelpId" placeholder="Confirm your password"
                                    autocomplete="off">
                            </div>
                        </div>

                        <div class="card">
                            <div class="mb-3">
                                <label for="" class="form-label">Profile Picture:</label>
                                <input type="file" class="form-control text-success"
                                    name="dp" id="" required>
                                <span class="text-danger">
                                    @error('dp')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">ID Image:</label>
                                <input type="file"  class="form-control text-success"
                                    name="idcard" id="" aria-describedby="idHelpId" required>
                                <span class="text-danger">
                                    @error('idcard')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                        </div>
                        
                        <div class="cardd" style="display:flex;justify-content:space-between">
                            <div class="mb-3">
                                <label for="" class="form-label">Gender:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                        id="flexRadioDefault1" value="Male">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                        id="flexRadioDefault2" Value="Female">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Female
                                    </label>
                                </div>
                                <span class="text-danger">
                                    @error('gender')
                                        {{ $message }}
                                    @enderror
                                    <span>
                            </div>
                            <div class="card">
                                <div class="mb-3">
                                    <label for="" class="form-label">Phone No.</label>
                                    <input type="text" class="form-control" name="phone" id=""
                                        aria-describedby="confHelpId" placeholder="Enter your phone number."
                                        autocomplete="off" required>
                                        <span class="text-danger">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                            <span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <button class="btn btn-primary" style="width:13rem;background:#1E2772;">Next</button>
                        </div>
                    </form>
                </div>
                <div class="col dam">
                    <img src="{{ asset('images/signup.png') }}" alt="">
                </div>
            </div>
        </div>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
