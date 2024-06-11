<!doctype html>
<html lang="en">

<head>
    <title>Log In to CRMS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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

        <div class="main">
            <div class="row ">
                <div class="col">
                    <div class="register">
                        <h2>Sign In to</h2>
                        <h2>CRMS</h2>
                        <span>If you don’t have an account you can
                            <a href="{{ url('/') }}/signup">Register here!</a></span>
                    </div>

                </div>
                <div class="col">
                    <img src="{{ asset('images/login.png') }}" alt="">
                </div>
                <div class="col">
                    <form action="{{ url('/') }}/login/verify" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" id=""
                                value="{{ session('tempmail') }}" aria-describedby="emailHelpId" autocomplete="off"
                                placeholder="Enter Email">
                            @if (session()->has('erroremail'))
                                <span class="text-danger">{{ session('erroremail') }}</span>
                            @endif
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" autocomplete="off" class="form-control" name="password"
                                id="" placeholder="Enter Password">
                            @if (session()->has('errorpass'))
                                <span class="text-danger">{{ session('errorpass') }}</span>
                            @endif
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="forgot">
                            <a href="">Forgot password?</a>
                        </div>
                        <button class="btn btn-primary">Sign In</button>
                    </form>
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
