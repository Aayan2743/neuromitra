<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from bestwpware.com/html/tf/duralux-demo/auth-reset-minimal.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 05:10:42 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="WRAPCODERS">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Reset Password</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
   


    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/icon/favicon.ico')}}" />
    {{-- <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/vendors.min.css')}}">
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme.min.css')}}">
    <!--! END: Custom CSS-->
    <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
    <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
    <!--[if lt IE 9]>
			<script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="assets/images/logo-abbr.png" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">Update Password</h2>
                        {{-- <h4 class="fs-13 fw-bold mb-2">Reset to your username/password</h4> --}}
                        {{-- <p class="fs-12 fw-medium text-muted">Enter your email and a reset link will sent to you, let's access our the best recommendation for you.</p> --}}
                        {{-- <form action="https://bestwpware.com/html/tf/duralux-demo/auth-resetting-minimal.html" class="w-100 mt-4 pt-2"> --}}

                            <form method="POST" action="{{ route('user.password.email') }}" class="w-100 mt-4 pt-2">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-4">
                                <label for="email" class="col-md-4 col-form-label text-md-en">{{ __('Email Address') }}</label>
                                {{-- <input class="form-control" placeholder="Email or Username" required> --}}
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                {{-- <input class="form-control" placeholder="Email or Username" required> --}}
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                {{-- <input class="form-control" placeholder="Email or Username" required> --}}
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            
                               
                            </div>



                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Update Now</button>
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Theme Customizer !-->
    <!--! ================================================================ !-->
  
    <!--! ================================================================ !-->
    <!--! [End] Theme Customizer !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->



    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="{{asset('assets/js/common-init.min.js')}}"></script>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !-->
    <script src="{{asset('assets/js/theme-customizer-init.min.js')}}"></script>
    <!--! END: Theme Customizer !-->
</body>


<!-- Mirrored from bestwpware.com/html/tf/duralux-demo/auth-reset-minimal.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 05:10:42 GMT -->
</html>