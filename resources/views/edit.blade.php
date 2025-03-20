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
                    <li class="breadcrumb-item"><a href="{{route('add.therapist')}}">Add Therapist</a></li>
                    <li class="breadcrumb-item">Edit Therapist</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                </div>
                <div class="d-md-none d-flex align-items-center">
                    {{-- <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a> --}}
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">

                {{-- <div class="col-xxl-12">
                    <div class="card stretch stretch-full">
                        <form action="{{ route('therapists.update', $therapist['0']->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Example input fields -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $therapist['0']->name }}"
                        required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $therapist['0']->email }}" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Password</label>
                    <input type="Password" class="form-control" id="password" name="password" value="">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Add more fields as necessary -->

                <button type="submit" class="btn btn-success">Update Therapist</button>
                </form>
            </div>
        </div> --}}

        <div class="col-xxl-12">
            <div class="card stretch stretch-full">
                <div class="card-header">
                    <h5 class="card-title">Update Therapist</h5>
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
                            <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown"
                                data-bs-offset="25, 25">
                                <div data-bs-toggle="tooltip" title="Options">
                                    <i class="feather-more-vertical"></i>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="card-body custom-card-action p-0">
                    <div class="card-body">
                        <form action="{{ route('therapists.update', $therapist['0']->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">


                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $therapist['0']->name }}" required>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror



                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $therapist['0']->email }}" required>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>

                                <div class="col-md-6">
                                    <input type="phone" class="form-control" id="phone" name="phone"
                                        value="{{ $therapist['0']->phone }}" required>
                                    @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input type="Password" class="form-control" id="password" name="password" value="">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Therapist') }}
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
</main>


@endsection