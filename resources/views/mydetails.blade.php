@extends('layouts.app2')

@section('content')
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                    <li class="breadcrumb-item">Update My Details</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        {{-- <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                            <span class="reportrange-picker-field"></span>
                        </div>
                        <div class="dropdown filter-dropdown">
                            <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10" data-bs-auto-close="outside">
                                <i class="feather-filter me-2"></i>
                                <span>Filter</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Role" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Role">Role</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Team" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Team">Team</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Email" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Email">Email</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Member" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Member">Member</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Recommendation" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Recommendation">Recommendation</label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-plus me-3"></i>
                                    <span>Create New</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-filter me-3"></i>
                                    <span>Manage Filter</span>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <!-- [Invoices Awaiting Payment] start -->

           



                <div class="col-xxl-12">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Update My Details</h5>
                            <div class="card-header-action">
                                <div class="card-header-btn">

                                    <div data-bs-toggle="tooltip" title="Refresh">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning"
                                            data-bs-toggle="refresh"> </a>
                                    </div>
                                    <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                            data-bs-toggle="expand"> </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="avatar-text avatar-sm"
                                        data-bs-toggle="dropdown" data-bs-offset="25, 25">
                                        <div data-bs-toggle="tooltip" title="Options">
                                            <i class="feather-more-vertical"></i>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>

                        @php    
                       // dd($mydetails[0]->id);
                        @endphp
                        <div class="card-body custom-card-action p-0">
                            <div class="card-body">
                                {{-- <form method="POST" action="{{ route('register') }}"> --}}
                                <form method="POST" action="{{ route('updatemydetails',$mydetails[0]->id) }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $mydetails[0]->name }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ $mydetails[0]->email }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="phone"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ $mydetails[0]->phone }}" required autocomplete="phone">

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password"  autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update My Details') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>



                        </div>

                    </div>
                </div>
               
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
    <!-- [ Footer ] start -->
    <footer class="footer">
        <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
            <span>Copyright ©</span>
            <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
            </script>
            <script>
                document.write(new Date().getFullYear());
            </script>
        </p>
        <div class="d-flex align-items-center gap-4">
            <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Help</a>
            <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Terms</a>
            <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Privacy</a>
        </div>
    </footer>
    <!-- [ Footer ] end -->
</main>

@endsection