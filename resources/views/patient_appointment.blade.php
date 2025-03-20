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
                   
                    <li class="breadcrumb-item">List Of Users Appointment</li>
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
                            <h5 class="card-title">List Of Users Appointment</h5>
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
                        <div class="card-body custom-card-action p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="border-b">
                                            <th>#</th>
                                            <th scope="row">Therapist Name</th>
                                            <th>Patient Name</th>
                                            <th>Date</th>
                                              <th>Therapy Name</th>
                                           
                                          
                                          
                                            <th>Download</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        


                                        @forelse ($get_patient_details as $user)
                                      

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    {{-- <div class="avatar-image">
                                                        <img src="{{asset('assets/images/avatar/2.png')}}" alt=""
                                                            class="img-fluid" />
                                                    </div> --}}
                                                    @if($user->therapist_user)
                                                    <span class="d-block">{{ $user->therapist_user->name }}</span>
                                                @else
                                                    <span class="d-block">No Therapist Assigned</span>
                                                @endif
                                                   
                                                        {{-- <span class="d-block"> {{$user->therapist_user->name}}</span> --}}
                                                        {{-- <span class="fs-12 d-block fw-normal text-muted"><span class="__cf_email__" data-cfemail="6e0f1c0d070b401a01000b1d2e09030f0702400d0103">[email&#160;protected]</span></span> --}}
                                                  
                                                </div>
                                            </td>
                                            <td>
                                                <span > {{$user->Full_Name}}</span>
                                            </td>
                                            <td>
                                                <span > {{$user->Date_of_appointment}}</span>
                                            </td>
                                            <td> {{$user->page_source}}</td>
                                            <td> 
                                                <style>
                                                    .action-buttons {
                                                        display: inline-flex;
                                                        gap: 10px; /* Adjust the gap as needed */
                                                    }
                                                </style>
                                                 
                                                 @if($user->appointment_status==2)

                                                 {{-- <div class="mt-4"> --}}
                                                    <div class="action-buttons">
                                                     <a href="{{ route('file.download', ['filename' => basename($user->file_path)]) }}"
                                                         class="btn btn-info">
                                                         Download File
                                                     </a>
                                                    </div>
                                                    
                                                    @else
                                                        In Process
                                                  @endif   


                                                {{-- <div class="action-buttons">
                                                    <a href="{{ route('file.download', ['filename' => basename($user->file_path)]) }}"
                                                        class="btn btn-info">
                                                        Download File
                                                    </a> --}}
                                                   
                                                    {{-- <a href="{{ route('therapists.edit', $user->id) }}" class="btn btn-primary btn-sm">Viewfff</a> --}}
                                                {{-- </div>     --}}
                                                
                                                {{-- <a href="{{ route('therapists.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
                                            
                                            
                                            
                                            </td>
                                           
                                          
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">No User Records Found</td>
                                        </tr>

                                        @endforelse

                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $get_patient_details->links('pagination::bootstrap-4') }}
                            {{-- <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                                <li>
                                    <a href="javascript:void(0);"><i class="bi bi-arrow-left"></i></a>
                                </li>
                                <li><a href="javascript:void(0);" class="active">1</a></li>
                                <li><a href="javascript:void(0);">2</a></li>
                                <li>
                                    <a href="javascript:void(0);"><i class="bi bi-dot"></i></a>
                                </li>
                                <li><a href="javascript:void(0);">8</a></li>
                                <li><a href="javascript:void(0);">9</a></li>
                                <li>
                                    <a href="javascript:void(0);"><i class="bi bi-arrow-right"></i></a>
                                </li>
                            </ul> --}}
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

@endsection