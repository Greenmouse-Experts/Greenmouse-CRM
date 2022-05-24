<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{config('app.name')}} | Register</title>

  <!-- Custom fonts for this template-->
  <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{URL::asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-success">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
            
              <div class="col-lg-6 offset-lg-3">
                <div class="py-5">
                  
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"> <img src="{{URL::asset('assets/img/reftophome-logo.png')}}" alt="{{config('app.name')}}"></h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('register') }}">
                        @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" aria-describedby="name" placeholder="Enter Your Name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" aria-describedby="email" placeholder="Enter Email Address" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control form-control-user @error('phone_number') is-invalid @enderror" aria-describedby="phone_number" placeholder="Enter Your Phone Number" required>
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Referral Code</label>
                        @if ($referrer_id == true)
                        <input type="text" name="referral_code" placeholder="{{$referrer_id}}" value="{{$referrer_id}}" class="form-control form-control-user" aria-describedby="referral_code" placeholder="Enter Referrer Code" readonly required>
                        @else
                        <input type="text" name="referral_code" class="form-control form-control-user" aria-describedby="referral_code" placeholder="Enter Referral Code" required>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-comfirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" placeholder="Enter Comfirm Password" type="password" class="form-control form-control-user" name="password_confirmation" required">
                    </div>

                    <div class="form-group">
                      <input type="submit" value="Register" class="btn btn-success btn-user btn-block">
                    </div>

                    <p>Already have an account?  <a href="/login">Login</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{URL::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{URL::asset('assets/js/sb-admin-2.min.js')}}"></script>

</body>

</html>