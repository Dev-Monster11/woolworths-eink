</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Woolworths</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendor1/css/poppins.css')}}"> <!-- Google Poppins Font -->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form p-l-55 p-r-55 p-t-128" method="POST" action="{{ route('register') }}">
                    @csrf
                    <span class="login100-form-title">
                        <img src="vendor1/images/logo.png" style = "margin-bottom: 5px;" alt="Home">
                        <h6>Electronic Ink Control Panel Register</h6>
                    </span>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter name">
                        <input class="input100 @error('name') is-invalid @enderror"  id="name" type="text" name="name" value="{{ old('name')}}" placeholder="Name" required autocomplete="name">
                        
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email">
                        <input class="input100" type="text" name="email" value="{{ old('email')}}" placeholder="Email Address">
                        
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter password">
                        <input class="input100" id="password" type="password" name="password" placeholder="Password">
                        
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Please enter confirm password">
                        <input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password">
                        
                    </div>


                    <div class="text-center p-t-13 p-b-23">
                        @error('name')
                            <span  style="color:red; font-size:13px;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('email')
                            <span style="color:red; font-size:13px;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('password')
                            <span style="color:red; font-size:13px;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <div class="flex-col-c p-t-170 p-b-40">
                        <a href="{{url('/')}}" class="txt3">
                            Go back to Sign In
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!--===============================================================================================-->
    <script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('js/main.js')}}"></script>

</body>

</html>
