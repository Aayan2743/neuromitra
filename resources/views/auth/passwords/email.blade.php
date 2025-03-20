<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from bestwpware.com/html/tf/duralux-demo/auth-reset-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 05:10:41 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="WRAPCODERS">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Forget Password</title>
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
    <main class="auth-cover-wrapper">
        <div class="auth-cover-content-inner">
            <div class="auth-cover-content-wrapper">
                <div class="auth-img">
                    <img src="{{asset('assets/images/auth/auth-cover-reset-bg.svg')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="auth-cover-sidebar-inner">
            <div class="auth-cover-card-wrapper">
                <div class="auth-cover-card p-sm-5">
                   
                    <div class="w-50 mb-5" style="min-width: 324px">
                        <img src="https://neuromitra.com/wp-content/uploads/2024/07/hy.jpg" alt="" width="500px" class="img-fluid">
                    </div>

                    <h2 class="fs-20 fw-bolder mb-4">Reset</h2>
                    {{-- <h4 class="fs-13 fw-bold mb-2">Reset to your username/password</h4> --}}
                    <p class="fs-12 fw-medium text-muted">Enter your email and a reset link will sent to you</p>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                    <form method="POST" action="{{ route('user.password.email') }}" class="w-100 mt-4 pt-2">
                        @csrf

                    {{-- <form action="https://bestwpware.com/html/tf/duralux-demo/auth-resetting-cover.html" class="w-100 mt-4 pt-2"> --}}
                        <div class="mb-4">
                            {{-- <input class="form-control" placeholder="Email or Username" required> --}}
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-lg btn-primary w-100">Reset Now</button>
                        </div>
                    </form>
                    
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


<!-- Mirrored from bestwpware.com/html/tf/duralux-demo/auth-reset-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 05:10:42 GMT -->
</html>