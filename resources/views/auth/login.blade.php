<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from bestwpware.com/html/tf/duralux-demo/auth-login-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 05:10:39 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="WRAPCODERS">
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title> Login</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/icon/favicon.ico')}}" />
  
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
  
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/vendors.min.css')}}">
      
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme.min.css')}}">
    
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-cover-wrapper">
        <div class="auth-cover-content-inner">
            <div class="auth-cover-content-wrapper">
                <div class="auth-img">
                    <img src="assets/images/auth/auth-cover-login-bg.svg" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="auth-cover-sidebar-inner">
            <div class="auth-cover-card-wrapper">
                <div class="auth-cover-card p-sm-5">
                    <div class="w-50 mb-5" style="min-width: 324px">
                        <img src="https://neuromitra.com/wp-content/uploads/2024/07/hy.jpg" alt="" width="500px" class="img-fluid">
                    </div>
                    <h2 class="fs-20 fw-bolder mb-4">Login </h2>
                    @if ($errors->has('error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error') }}
                        </div>
                    @endif

                        <form method="POST" action="{{ route('user.login') }}" class="w-100 mt-4 pt-2">
                            @csrf
    
                        <div class="mb-4">
                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            {{-- <input type="email" class="form-control" placeholder="Email or Username" value="wrapcode.info@gmail.com" required> --}}
                        </div>
                        <div class="mb-3">
                            <input id="password" type="password" placeholder="Password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                            {{-- <input type="password" class="form-control" placeholder="Password" value="123456" required> --}}
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                    <label class="custom-control-label c-pointer" for="rememberMe">Remember Me</label>
                                </div>
                            </div>
                            <div>
                                @if (Route::has('user.password.request'))
                                <a class="btn btn-link" href="{{ route('user.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                                {{-- <a href="auth-reset-cover.html" class="fs-11 text-primary">Forget password?</a> --}}
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                        </div>
                    </form>
                    
                   
                </div>
            </div>
        </div>
    </main>
   
    <!--! BEGIN: Vendors JS !-->
    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
   
    <script src="{{asset('assets/js/common-init.min.js')}}"></script>
   
    <script src="{{asset('assets/js/theme-customizer-init.min.js')}}"></script>
   
</body>


<!-- Mirrored from bestwpware.com/html/tf/duralux-demo/auth-login-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Sep 2024 05:10:39 GMT -->
</html>