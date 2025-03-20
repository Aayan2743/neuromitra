@extends('layouts.app2')
@section('content')
<style>
.appointment-card {
    width: 300px;
    margin: 20px;
    padding: 15px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    transition: transform 0.3s ease;
}

.appointment-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.card-header {
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.card-header h3 {
    margin: 0;
    font-size: 1.2em;
    color: #333;
}

.card-body {
    font-size: 0.95em;
    color: #555;
}

.card-body p {
    margin: 5px 0;
}

.card-body p strong {
    color: #000;
}

.card-title {
    text-align: right; /* Adjust the alignment if necessary */
    margin-top: 20px;   /* Adds space between the card and the title */
    color: #333;        /* Optional: Customize text color */
}
</style>

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                  
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" >List Of Behaviour </a></li>
                    <li class="breadcrumb-item">List Of Behaviour</li>
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
        <div class="main-content mb-5 pb-5">
            <div class="row">
                <!-- [Invoices Awaiting Payment] start -->
                <!-- [Conversion Rate] end -->
                <!-- [Payment Records] start -->
                <!-- [Total Sales] end !-->
                <!-- [Mini] start -->
                <!-- [Mini] end !-->
                <!-- [Leads Overview] start -->
                <!-- [Leads Overview] end -->
                <!-- [Latest Leads] start -->
                <div class="col-xxl-12">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">List Of Clinets Behaviour  </h5>

                           
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
                            </div>
                        </div>
                        <div class="card-body custom-card-action p-0">
                            @php

                                //   dd(Auth::user());
                            @endphp
                           
                           <div style="text-align: right">

                            <a href="{{ route('addbehaviourdetails', ['aid' => request()->route('id')]) }}" class="btn btn-primary card-title mt-3 me-3">
                                Add New 
                            </a>

                            {{-- <a href="{{route('addbehaviourdetails',request()->route('id') }}" class="btn btn-primary card-title mt-3 me-3" >Add New  {{ request()->route('id') }}</a> --}}
                        </div>
                        
                        <!-- Modal Structure -->
                      
                         
                             <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="border-b">
                                            <th>#</th>
                                            <th>Client Name</th>
                                            <th>Therapist Name</th>
                                            <th>Date</th>
                                            <th>Therapist Type</th>
                                            <th>Details</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        //$get_details=App\Models\appointments::all();
                                        // dd($get_details);
                                        @endphp
                                          @forelse ($get_behavirual as $user)
                
                                        @php
                                           // dd($user->id);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                  
                                                    <span class="d-block"
                                                        style="text-transform: capitalize;">  {{ $user->pname }}</span>
                                                    {{-- <span class="fs-12 d-block fw-normal text-muted"><span class="__cf_email__" data-cfemail="6e0f1c0d070b401a01000b1d2e09030f0702400d0103"></span></span> --}}
                                                </div>
                                            </td>
                                            <td>{{ $user->uname }}</td>
                                            <td> {{ $user->data_details}}</td>
                                            <td>
                                                 {{ $user->details}}
                                            </td>
                                            <td style="text-transform: capitalize;">{{ $user->page_source }}</td>
                                           
                                           
                                           
                                            @empty
                                        <tr>
                                            <td colspan="8">No appointments found</td>
                                        </tr>
                                        @endforelse
                                        </tr>
                                    </tbody>
                                </table>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        text: '{{ session('success') }}',
                                        timer: 3000,
                                        showConfirmButton: false
                                    });
                                </script>
                                @endif
                            </div>
                            
                           
                            
                            <!-- Moved h5 to the end -->
                          
                        </div>
                           
           
        </div>
       
    </div>
    </div>
    <!-- [Latest Leads] end -->
    <!--! BEGIN: [Upcoming Schedule] !-->
    <!--! END: [Team Progress] !-->
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#appointment_date_range", {
            mode: "range",
            dateFormat: "Y-m-d",
            // Optional: You can add minDate and maxDate if needed
            // minDate: "2024-01-01",
            // maxDate: "2024-12-31",
        });
    });
</script>
@endsection