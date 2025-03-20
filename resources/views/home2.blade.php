@extends('layouts.app2')

@section('content')



<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin Dashboard </h5>
                </div>
                
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    {{-- <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                            <span class="reportrange-picker-field"></span>
                        </div>
                        <div class="dropdown filter-dropdown" style="display: none">
                            <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-filter me-2"></i>
                                <span>Filter</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Role"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Role">Role</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Team"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Team">Team</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Email"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Email">Email</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Member"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Member">Member</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Recommendation"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer"
                                            for="Recommendation">Recommendation</label>
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
                        </div>
                    </div> --}}
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
                            <h5 class="card-title">List Of Patients</h5>


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

                                @if (session('welcome'))
                              
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Welcome!',
                                        text: '{{ session('welcome') }}',
                                        timer: 3000,
                                        showConfirmButton: false
                                    });
                                </script>
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


                            @if (session('error'))
                              
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Alert!',
                                    text: '{{ session('error') }}',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            </script>
                          @endif

                            </div>
                        </div>

                        <div class="card-body custom-card-action p-0">
                            <form method="GET" action="{{ route('users.index') }}" class=" mb-4">
                                <div class="form-group mt-3 filters d-flex " style="place-content: center">
                                    
                                    {{-- date filter --}}
                                    
                                    {{-- <div class="filter-group ms-4">
                                        <label for="appointment_date">Appointment Date</label>
                                        <div class="mt-2">
                                            <input type="date" id="appointment_date" name="appointment_date" class="form-control" value="{{ request('appointment_date') }}" onchange="this.form.submit()">
                                        </div>
                                    </div> --}}
                                    

                                    
                                    <div class="filter-group ms-4">
                                        <label for="appointment_date_range">Appointment Date Range</label>
                                        <div class="mt-2">

                                            <input type="date"  style="padding: 7px !important " name="appointment_date" class="form-control" value="{{ request('appointment_date') }}" onchange="this.form.submit()">
                                            {{-- <input type="text" id="appointment_date_range" name="appointment_date_range" class="form-control" value="{{ request('appointment_date_range') }}" onchange="this.form.submit()"> --}}
                                        </div>
                                    </div>

                                    
                                    <div class="filter-group ms-4">
                                        <label for="appointment_page">Appointment Type</label>
                                        <div class="mt-2">
                                            <select id="appointment_pag" style="padding: 5px !important " name="appointment_page" class="form-select" onchange="this.form.submit()">
                                                <option value="">Select</option>
                                                @foreach($page_source1 as $type)
                                                    <option value="{{ $type }}" {{ request('appointment_page') == $type ? 'selected' : '' }}>
                                                        {{ ucfirst($type) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>




                                    <div class="filter-group ms-4">
                                        <label for="appointment_type">Appointment Type</label>
                                        <div class="mt-3">
                                            <input type="radio" id="online" name="appointment_type" value="online" 
                                                   {{ request('appointment_type') == 'online' ? 'checked' : '' }}
                                                   onchange="this.form.submit()">
                                            <label for="online">Online</label>
                            
                                            <input type="radio" class="ms-2" id="offline" name="appointment_type" value="offline" 
                                                   {{ request('appointment_type') == 'offline' ? 'checked' : '' }}
                                                   onchange="this.form.submit()">
                                            <label for="offline">Offline</label>
                                        </div>
                                    </div>
                            
                                    <div class="filter-group ms-5">
                                        <label for="appointment_status">Appointment Status</label>
                                        <div class="mt-3">
                                            <input type="radio" id="confirmed" name="appointment_status" value="closed"
                                                   {{ request('appointment_status') == 'closed' ? 'checked' : '' }}
                                                   onchange="this.form.submit()">
                                            <label for="confirmed">Closed</label>
                            
                                            <input type="radio" id="pending" class="ms-2" name="appointment_status" value="opened"
                                                   {{ request('appointment_status') == 'opened' ? 'checked' : '' }}
                                                   onchange="this.form.submit()">
                                            <label for="pending">Opened</label>

                                            <input type="radio" id="inprocess" class="ms-2" name="appointment_status" value="InProcess"
                                                   {{ request('appointment_status') == 'InProcess' ? 'checked' : '' }}
                                                   onchange="this.form.submit()">
                                            <label for="pending">InProcess</label>
                            
                                            
                                        </div>
                                    </div>

                                   
                            
                                    <div class="filter-group ms-5 mt-3">
                                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Reset</a>
                                    </div>

                                   
                                </div>

                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="border-b">

                                            <th>#</th>

                                            <th>Full Name</th>
                                            <th>Phone</th>
                                            <th>Age</th>
                                            <th>Appointment Type</th>
                                            <th>Appointment For</th>
                                            <th>Date Of Appointment</th>
                                            <th>Location</th>
                                            <th>Soure</th>
                                            <th>Action</th>


                                            {{-- <th scope="row">Therapist Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        //$get_details=App\Models\appointments::all();

                                        // dd($get_details);
                                        @endphp
                                        @forelse ($get_details as $user)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    {{-- <div class="avatar-image">
                                                        <img src="assets/images/avatar/2.png" alt=""
                                                            class="img-fluid" />
                                                    </div> --}}

                                                    <span class="d-block"  style="text-transform: capitalize;">{{ $user->Full_Name }}</span>
                                                    {{-- <span class="fs-12 d-block fw-normal text-muted"><span class="__cf_email__" data-cfemail="6e0f1c0d070b401a01000b1d2e09030f0702400d0103"></span></span> --}}

                                                </div>
                                            </td>

                                            <td>{{ $user->phone_Number }}</td>
                                            <td>{{ $user->age}}</td>
                                            <td>
                                                @if($user->appointment_type==1)
                                                <span
                                                    class="badge bg-soft-success text-success">{{ $user->appointment_type == 1 ? 'Online' : 'Offline'  }}</span>
                                                @else
                                                <span
                                                    class="badge bg-soft-danger text-danger">{{ $user->appointment_type == 1 ? 'Online' : 'Offline'  }}</span>
                                                @endif

                                            </td>
                                            <td style="text-transform: capitalize;">{{ $user->appointment }}</td>
                                            <td>{{ $user->Date_of_appointment }}</td>
                                            <td style="text-transform: capitalize;">{{ $user->location }}</td>
                                            <td style="text-transform: capitalize;">{{ $user->page_source }}</td>
                                            <td style="text-transform: capitalize;">
                                                @auth
                                                @if(Auth()->user()->user_type==2)
                                                @php
                                               
                                                $therapist = App\Models\User::find($user->therapist_id);
                                                // Ensure therapist exists
                                                 // dd($therapist);  


                                                $therapist_name = $therapist ? $therapist->name : 'Open';

                                                @endphp
                                                   
                                                   @if($user->appointment_status==1)
                                                         Assigned   {{ $therapist_name }}
                                                    @elseif($user->appointment_status==2)
                                                        Close   {{ $therapist_name }}
                                                    @elseif($user->appointment_status==0)
                                                  
                                                    <form  action="{{ route('assign_therapist') }}" method="POST" >
                                                        @csrf
                                                        <div class="filter-group">
                                                            {{-- <label for="therapist_id">List Of Therapist</label> --}}
                                                            <input type="hidden" name="bookingid" id="bookingid" value="{{$user->id}}"/>
                                                            <input type="hidden" name="therapistname" id="therapistname" value="{{$therapist_name}}"/>
                                                            <div class="mt-2">
                                                                <select id="therapist_ids" style="padding: 5px !important" name="therapist_id" class="form-select">
                                                                    <option value="">Select Therapist</option>
                                                                    @foreach($list_of_therapist as $type)
                                                                        <option value="{{ $type->id }}">
                                                                            {{ $type->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="filter-group ms-5 mt-3">
                                                            <button type="submit" class="btn btn-primary">Assign</button>
                                                        </div>
                                                    </form>

                                                
                                              
                                                   @endif

                                                   
                                                {{-- Display the therapist's name --}}
                                                
                                                



                                                {{-- Name Will come here --}}
                                                @else
                                                <form action="{{ route('appointments.changeStatus', $user->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($user->appointment_status=='1')
                                                    {{'Appointment Closed'}}
                                                    @else
                                                    <button type="submit" class="btn btn-warning">
                                                        Grab Me
                                                    </button>
                                                    @endif

                                                </form>
                                                @endif
                                                @endauth
                                            </td>


                                            @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No appointments found</td>
                                        </tr>
                                        @endforelse

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $get_details->links('pagination::bootstrap-4') }}
                            
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('submit', '#assignTherapistForm', function (e) {
            e.preventDefault(); // Prevent the default form submission
            
            // Clear previous error messages
            $('.error-message').remove();

            var therapistId = $('#therapist_ids').val(); // Get the therapist ID
            var bookingId = $('#bookingid').val(); // Get the booking ID

            // Validate the form data
            if (!therapistId) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please select a therapist.',
                    confirmButtonText: 'OK'
                });
                return; // Exit the function if validation fails
            }

            // Prepare data to send via AJAX
            var formData = {
                therapist_id: therapistId,
                bookingid: bookingId // Include the booking ID
            };

            // AJAX POST request
            $.ajax({
                url: "{{ route('assign_therapist') }}",  // The route to send data to
                type: "POST",
                data: JSON.stringify(formData), // Convert the object to a JSON string
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),  // CSRF token for security
                    'Content-Type': 'application/json'  // Specify the content type as JSON
                },
                dataType: "json",  // Expect a JSON response
                success: function (response) {
                    // Show success message with SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,  // Display the success message from the server
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();  // Reload the page if needed
                        }
                    });
                },
                error: function (xhr) {
                    if (xhr.status === 422) {  // Unprocessable Entity
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = 'Please correct the following errors:<br>';

                        $.each(errors, function (key, value) {
                            errorMessage += value[0] + '<br>';  // Add each error to the message
                        });

                        // Show validation errors with SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: errorMessage,  // Use HTML to format the error message
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Handle other types of errors (e.g., server errors)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An unexpected error occurred.',
                            confirmButtonText: 'Try Again'
                        });
                    }
                }
            });
        });
    });
</script>





@endsection