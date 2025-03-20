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
                    <li class="breadcrumb-item"><a href="{{route('add.addpatient')}}">Add Clients</a></li>
                    <li class="breadcrumb-item">Add Booking </li>
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
                            <h5 class="card-title">Add Bookings</h5>
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
                            <div class="card-body">
                                {{-- <form method="POST" action="{{ route('register') }}"> --}}
                                <!-- Ensure Bootstrap CSS is included in the head of your HTML -->



    <form method="POST" action="{{route('bookappointment')}}">

        @csrf
        <div class="container">
            <div class="row">
              
              <div class="col-xs-12 col-sm-4">
                <div class="box">
                    <label for="fullname" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Client Name') }}</label>
                    <div class="row mb-3">
                        <input type="hidden" name="user_id" value={{request()->id}} />
                        <div class="col-md-12">
                            <select id="fullname" class="form-control  @error('fullname') is-invalid @enderror" name="fullname" required>
                                <option value="">Select Name</option>

                             
                                @foreach ($myfamily as $item)
                               
                                <option value="{{$item->pid}}" >{{$item->pname}}</option>
                                @endforeach
                              
                               
                             
                                <!-- Add more options as needed -->
                            </select>
                    
                            @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <a href="{{route('adduserclients',request()->id)}}" >Add Patients</a>
                    </div>
                    
                </div>
              </div>
              
              <div class="col-xs-12 col-sm-4">
                <div class="box">
                    <label for="name" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Phone') }}</label>
                    <input id="name" 
                    type="text" pattern="\d{10}" title="Invalid Phone Number" 
                    class=" form-control @error('name') is-invalid @enderror" name="Phone" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
              </div>
              
              <div class="col-xs-12 col-sm-4">
                <div class="box">
                    <label for="appointmentfor" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Appointment For') }}</label>
                    <div class="row mb-3">
                      
                        <div class="col-md-12">
                            <select id="appointmentfor" class="form-control  @error('appointmentfor') is-invalid @enderror" name="appointmentfor" required>
                                <option value="">Select Appointment For</option>
                                <option value="Self" {{ old('appointmentfor') == 'Self' ? 'selected' : '' }}>Self</option>
                                <option value="Child" {{ old('appointmentfor') == 'Child' ? 'selected' : '' }}>Child</option>
                             
                                <!-- Add more options as needed -->
                            </select>
                    
                            @error('appointmentfor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
              </div>
              
            </div>
            <div class="row">
              
                <div class="col-xs-12 col-sm-4">
                    <div class="box">
                        <label for="appointmenttype" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Appointment Type') }}</label>
                        <div class="row mb-3">
                          
                            <div class="col-md-12">
                                <select id="appointmenttype" class="form-control  @error('appointmentfor') is-invalid @enderror" name="appointmenttype" required>
                                    <option value="">Select Appointment Type</option>
                                    <option value="0" {{ old('appointmenttype') == '0' ? 'selected' : '' }}>Online</option>
                                    <option value="1" {{ old('appointmenttype') == '1' ? 'selected' : '' }}>Offline</option>
                                 
                                    <!-- Add more options as needed -->
                                </select>
                        
                                @error('appointmentfor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-4">
                  <div class="box">
                      <label for="name" style="padding-left: 0;" class="col-md-12 col-form-label ms-0">{{ __('Date of Appointment') }}</label>
                      <input id="name" type="date" class=" form-control @error('name') is-invalid @enderror" name="dateofappointment" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                </div>
                
                <div class="col-xs-12 col-sm-4">
                    <div class="box">
                        <label for="selectlocation" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Select Location') }}</label>
                        <div class="row mb-3">
                          
                            @php
                                
                                $check_user_exist_addess=App\Models\useraddressdetail::where('uid',request()->id)->get();

                                // dd($check_user_exist_addess);   


                            @endphp

                            <div class="col-md-12">
                                <select id="selectlocation" class="form-control  @error('selectlocation') is-invalid @enderror" name="selectlocation" required>
                                    <option value="">Select Appointment Type</option>
                                  
                                @foreach($check_user_exist_addess as $data)
                                <option value="{{$data['id']}}">{{$data['type_of_address']==0 ? 'Present' : 'permanent'}}</option>
                                @endforeach
                                  
                                    {{-- <option value="1" {{ old('selectlocation') == '1' ? 'selected' : '' }}>Permanent</option> --}}
                                 
                                    <!-- Add more options as needed -->
                                </select>
                                {{-- {{route('adduseraddress',request()->id)}} adduseraddress --}}
                                <a href="{{route('adduseraddress',request()->id)}}" >Add address</a>
                        
                                @error('appointmentfor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>

            <div class="row">
              
                <div class="col-xs-12 col-sm-4">
                  <div class="box">
                      <label for="name" style="padding-left: 0;" class="col-md-12 col-form-label ms-0">{{ __('Appointment Time') }}</label>
                      <input id="name" type="time" class=" form-control @error('name') is-invalid @enderror" name="Appointmenttime" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <div class="box">
                        <label for="selectlocation" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Therapy Type') }}</label>
                        <div class="row mb-3">
                          
                            <div class="col-md-12">
                                <select id="therapytype" class="form-control  @error('therapytype') is-invalid @enderror" name="therapytype" required>
                                    <option value="">Select Therapy Type</option>
                                    <option value="Relationship Counseling for Couples" {{ old('therapytype') == 'Relationship Counseling for Couples' ? 'selected' : '' }}>Relationship Counseling for Couples</option>
                                    <option value="Behavioral Counseling" {{ old('therapytype') == 'Behavioral Counseling' ? 'selected' : '' }}>Behavioral Counseling</option>
                                   
                                   
                                    <option value="Grief Counseling" {{ old('therapytype') == 'Grief Counseling' ? 'selected' : '' }}>Grief Counseling</option>
                                    <option value="Group Counseling" {{ old('therapytype') == 'Group Counseling' ? 'selected' : '' }}>Group Counseling</option>
                                    <option value="Crisis Counseling" {{ old('therapytype') == 'Crisis Counseling' ? 'selected' : '' }}>Crisis Counseling</option>
                                    <option value="Career Counseling for Parents" {{ old('therapytype') == 'Career Counseling for Parents' ? 'selected' : '' }}>Career Counseling for Parents</option>
                                    <option value="Sibling Counseling" {{ old('therapytype') == 'Sibling Counseling' ? 'selected' : '' }}>Sibling Counseling</option>
                                    <option value="Educational Counseling" {{ old('therapytype') == 'Educational Counseling' ? 'selected' : '' }}>Educational Counseling</option>
                                    <option value="Parent-Child Relationship Counseling" {{ old('therapytype') == 'Parent-Child Relationship Counseling' ? 'selected' : '' }}>Parent-Child Relationship Counseling</option>
                                    <option value="Individual Counseling for Children" {{ old('therapytype') == 'Individual Counseling for Children' ? 'selected' : '' }}>Individual Counseling for Children</option>
                                    <option value="Family Counseling" {{ old('therapytype') == 'Family Counseling' ? 'selected' : '' }}>Family Counseling</option>
                                    <option value="Mental Health Counseling" {{ old('therapytype') == 'Mental Health Counseling' ? 'selected' : '' }}>Mental Health Counseling</option>
                                    <option value="General Stress Management Counseling" {{ old('therapytype') == 'General Stress Management Counseling' ? 'selected' : '' }}>General Stress Management Counseling</option>
                                    <option value="Parent Counseling for Autism" {{ old('therapytype') == 'Parent Counseling for Autism' ? 'selected' : '' }}>Parent Counseling for Autism</option>
                                 
                                    <!-- Add more options as needed -->
                                </select>
                              
                        
                                @error('appointmentfor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                </div>
                
              
               
                
            </div>

             </div>

        <button type="submit" class="btn btn-primary">Add Booking</button>
    </form>



                            </div>



                        </div>

                    </div>
                </div>
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
                            <h5 class="card-title">My Appointment Details</h5>
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
                                            <th scope="row">Client Name</th>
                                          
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        


                                        @forelse ($myfamily as $therapist)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    {{-- <div class="avatar-image">
                                                        <img src="{{asset('assets/images/avatar/2.png')}}" alt=""
                                                            class="img-fluid" />
                                                    </div> --}}
                                                   
                                                        <span class="d-block"> {{$therapist->pname}}</span>
                                                        {{-- <span class="fs-12 d-block fw-normal text-muted"><span class="__cf_email__" data-cfemail="6e0f1c0d070b401a01000b1d2e09030f0702400d0103">[email&#160;protected]</span></span> --}}
                                                  
                                                </div>
                                            </td>
                                          
                                         
                                           
                                            <td>
                                               
                                                <style>
                                                    .action-buttons {
                                                        display: inline-flex;
                                                        gap: 10px; /* Adjust the gap as needed */
                                                    }
                                                </style>

                                                <div class="action-buttons">
                                                  
                                                    @php

                                                          $count_of_appointment=App\Models\appointments::where('pid',$therapist->pid)->count();  
                                                    @endphp


                                                    <a href="{{route('get_partient_appointment1',$therapist->pid)}}" class="btn btn-primary btn-sm">
                                                        View {{$therapist->pname}} Details  <span class="badge badge-light">{{$count_of_appointment}}</span>
                                                        <span class="sr-only">unread messages</span>
                                                    </a>
                                                      
                                                  
                                                    {{-- <a href="{{route('get_partient_appointment1',$therapist->pid)}}" class="btn btn-primary btn-sm">View {{$therapist->pname}} Details  </a> --}}
                                                </div>   



                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No Therapist Records Found</td>
                                        </tr>

                                        @endforelse

                                        {{-- <div class="pagination justify-content-center">
                                            {{ $get_all_therapists->links('pagination::bootstrap-4') }}
                                        </div> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center" >
                            {{ $get_all_therapists->links('pagination::bootstrap-4') }}
                           
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

  
<script>
   
   function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result1) => {
         
        console.log(result1.isConfirmed);
         // return false; 
        
        if (result1.isConfirmed) {
            // Send the delete request via AJAX
            var form = document.getElementById('delete-form-' + id);
            console.log(form);
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Deleted!',
                        'The therapist has been deleted.',
                        'success'
                    ).then(() => {
                        // Reload the page after the alert is confirmed
                        location.reload();
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'Something went wrong.',
                        'error'
                    );
                }
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    'Something went wrong.',
                    'error'
                );
            });
        }else {
            // Optionally, you can handle the Cancel case here if needed
            Swal.fire(
                'Cancelled',
                'The Client is safe :)',
                'error'
            );
        }
    });
}

   
 
</script>


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