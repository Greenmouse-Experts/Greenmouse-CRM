<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{config('app.name')}} | Login</title>

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{URL::asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>
<style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css");

    /* Lastest Login */
    .logIn {
        margin-top: 130px;
    }

    .logIn .fine {
        text-align: center;
        margin-top: 30px;
    }

    .logIn .fine a {
        color: #9DB940 !important;
    }

    .logIn .sign .sign-div img {
        width: 180px;
        display: block;
        margin: auto;
    }

    .logIn .sign .sign-div {
        background-color: #fff;
        box-shadow: 0px 0px 20px rgba(136, 136, 136, 0.219);
        border-radius: 10px;
        width: 100%;
        padding: 40px 20px;
        margin-top: 20px;
    }

    @media (max-width:1200px) {
        .logIn .sign .sign-div {
        background-color: #fff;
        width: 100%;
        padding: 40px 10px;
        margin-top: 20px;
    }
    .logIn {
        margin-top: 80px;
    }
    }

    .logIn .sign h4 {
        font-size: 20px;
        color: #000000;
        padding: 0px 0 10px 0px;
        font-weight: 600;
    }

    .logIn .sign .sign-div ::placeholder {
        font-size: 12px;
        color: #eee;
    }

    .logIn .sign .sign-div label {
        font-size: 13px;
        margin-bottom: 5px;
        color: #000;
    }

    .logIn .sign .sign-div input {
        display: block;
        width: 100%;
        padding: 10px 5px 10px 48px;
        border-radius: 5px;
        border: 1px solid #eee;
        background-color: #fff;
        font-size: 14px;
        transition: 0.6s;
    }

    .logIn .sign .sign-div .bi {
        position: absolute;
        margin-top: 10px;
        margin-left: 10px;
        border-right: 1px solid #eee;
        font-size: 19px;
        padding-right: 8px;
        padding-top: 0px;
        color: #999797;
    }

    .logIn .sign .sign-div a {
        text-decoration: none;
        color: #fff;
        font-weight: 700;
    }

    .logIn .sign .sign-div p {
        font-size: 13px;
        margin-top: 10px;
    }

    .logIn .sign .sign-div button {
        display: block;
        margin: auto;
        margin-top: 30px;
        width: 100%;
        padding: 10px;
        text-align: center;
        border: none;
        background-color: #95B343;
        color: #fff;
        border-radius: 5px;
    }

    /**********lOGIN ENDS*************/

    /* Lastest Login Ends */
</style>

<body class="bg-gradient-success">
    <div class="container">
        <!-- Outer Row -->
        <!-- <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="py-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> <img src="{{URL::asset('assets/img/greenmouse-logo.png')}}" alt="logo" width="300px"></h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Emaill</label>
                                            <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <label style="float: right;">
                                                @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" style="text-decoration: none; color: #000; font-size: 13px !important; font-weight: 400;">{{ __('Forgot Your Password?') }}</a>
                                                @endif
                                            </label>
                                            <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Login" class="btn btn-success btn-user btn-block">
                                        </div>
                                        <p>Don't have an account? <a href="/register">Register</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <section class="logIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="sign">
                        <form class="sign-div">
                            <a href="index">
                                <img src="{{URL::asset('assets/img/greenmouse-logo.png')}}">
                            </a>
                            <h4 class="mb-2 mt-4 text-center">Log Into Your Account</h4>
                            <!--Username-->
                            <div class="col-lg-12">
                                <label>Email</label>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <i class="bi bi-person-circle"></i>
                                        <input type="email" placeholder="Enter Your Email Address" name="username" class="input" required>
                                    </div>
                                </div>
                            </div>
                            <!--Username Ends-->
                            <!--Password-->
                            <div class="col-lg-12">
                                <label>Password</label>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <i class="bi bi-file-earmark-lock"></i>
                                        <input type="password" placeholder="Enter your Password" name="email" class="input" required>
                                    </div>
                                </div>
                            </div>
                            <!--Password-->
                            <div class="col-md-12 mb-3">
                                <button type="submit" value="Login">LogIn</button>
                            </div>
                            <p class="fine">Don't have an account ? <a href="/register">Register</a> </p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JavaScript-->
    <script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{URL::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{URL::asset('assets/js/sb-admin-2.min.js')}}"></script>
    <script>
        // Script for Show/Hide Password
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
</body>

</html>
