@extends('layouts.app2')
@section('content')
<style>
    .file_upload_button {
  background-color: indigo;
  color: white;
  padding: 0.5rem;
  font-family: sans-serif;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 1rem;
}
    </style>

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Therapist Dashboard</h5>
                </div>
                {{-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                </ul> --}}
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
                            </div>
                        </div>
                        <div class="card-body custom-card-action p-0">
                            <form method="GET" action="{{ route('users1.index') }}" class=" mb-4">
                                <div class="form-group mt-3 filters d-flex " style="place-content: center">
                                    {{-- date filter --}}
                                    {{-- <div class="filter-group ms-4">
                                        <label for="appointment_date">Appointment Date</label>
                                        <div class="mt-2">
                                            <input type="date" id="appointment_date" name="appointment_date" class="form-control" value="{{ request('appointment_date') }}"
                                    onchange="this.form.submit()">
                                </div>
                        </div> --}}
                        <div class="filter-group ms-4">
                            <label for="appointment_date_range">Appointment Date Range</label>
                            <div class="mt-2">
                                <input type="date" style="padding: 7px !important " name="appointment_date" class="form-control"
                                    value="{{ request('appointment_date') }}" onchange="this.form.submit()">
                                {{-- <input type="text" id="appointment_date_range" name="appointment_date_range" class="form-control" value="{{ request('appointment_date_range') }}"
                                onchange="this.form.submit()"> --}}
                            </div>
                        </div>
                        <div class="filter-group ms-4">
                            <label for="appointment_page">Appointment Type</label>
                            <div class="mt-2">
                                <select style="padding: 5px !important " name="appointment_page" class="form-select"
                                    onchange="this.form.submit()">
                                    <option value="">Select </option>
                                    @foreach($page_source1 as $type)
                                    <option value="{{ $type }}"
                                        {{ request('appointment_page') == $type ? 'selected' : '' }}>
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
                        {{-- <div class="filter-group ms-5">
                                        <label for="appointment_status">Appointment Status</label>
                                        <div class="mt-2">
                                            <input type="radio" id="confirmed" name="appointment_status" value="closed"
                                                   {{ request('appointment_status') == 'closed' ? 'checked' : '' }}
                        onchange="this.form.submit()">
                        <label for="confirmed">Closed</label>
                        <input type="radio" id="pending" class="ms-2" name="appointment_status" value="opened"
                            {{ request('appointment_status') == 'opened' ? 'checked' : '' }}
                            onchange="this.form.submit()">
                        <label for="pending">Opened</label>
                        <!-- <input type="radio" id="cancelled" name="appointment_status" value="cancelled"
                                                   {{ request('appointment_status') == 'cancelled' ? 'checked' : '' }}
                                                   onchange="this.form.submit()">
                                            <label for="cancelled">Cancelled</label> -->
                    </div>
                </div> --}}
                <div class="filter-group ms-5 mt-2">
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

                        @php
                           // dd($user->id);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    {{-- <div class="avatar-image">
                                                        <img src="assets/images/avatar/2.png" alt=""
                                                            class="img-fluid" />
                                                    </div> --}}
                                    <span class="d-block"
                                        style="text-transform: capitalize;">{{ $user->Full_Name }}</span>
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
                                $therapist_name = $therapist ? $therapist->name : 'Therapist not found';
                                @endphp
                                {{-- Display the therapist's name --}}
                                <p> {{ $therapist_name }}</p>
                                {{-- Name Will come here --}}
                                @else

                                {{-- @if(isset($appointment) && $appointment->file_path) --}}
                                @if($user->appointment_status==2)

                                {{-- <div class="mt-4"> --}}
                                    <div class="row">

                                        <div class="col-auto">
                                            <a href="{{route('addbehavioursss',$user->id) }}"
                                                class="btn btn-info">
                                                Behaviour Details
                                            </a>
                                        </div>

                                        <div class="col-auto">
                                            <a href="{{ route('file.download', ['filename' => basename($user->file_path)]) }}"
                                                class="btn btn-info">
                                                <i class="bi bi-cloud-arrow-down"></i> 
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                          
                                            <form action="{{ route('appointments.changeCloseStatus', $user->id) }}" method="POST"
                                                style="display:inline;" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                            
                                                {{-- {{'Assigned To You'}} --}}
                                               
                                                         <div class="d-flex align-items-center">
                                                   
                                                    <label class="file_upload_button mt-0" for="actual-btn-{{$user->id}}">Choose File</label>

                                                    <input type="file" name="uploadFile"  id="actual-btn-{{$user->id}}"  hidden>
                                                  
                                                    <button type="submit" class="btn btn-warning ms-2">Close</button>
                                                </div>
                                               
                                               
                                              
                                             
                                             
                                            </form>

                                        </div>
                                    </div>
                                    
                                {{-- </div> --}}
                                    @else

                                    <form action="{{ route('appointments.changeCloseStatus', $user->id) }}" method="POST"
                                        style="display:inline;" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        @if($user->appointment_status=='1')
                                        {{-- {{'Assigned To You'}} --}}
                                       
                                        <div class="d-flex align-items-center">
                                                   
                                            <label class="file_upload_button" for="actual-btn2-{{$user->id}}">Choose File</label>

                                            <input type="file" name="uploadFile"  id="actual-btn2-{{$user->id}}"  hidden>
                                          
                                            <button type="submit" class="btn btn-warning ms-2">Close1</button>
                                        </div>
                                       
                                       
                                        {{-- <label for="uploadFile">Upload File:</label>
                                        <input type="file" name="uploadFile" id="uploadFile" class="form-control" required>
                                        <button type="submit" class="btn btn-warning">
                                            Close
                                        </button> --}}
                                        @else
                                        Session Closed
                                        @endif
                                    </form>

                                @endif


                               


                               
                                @endif
                                @endauth
                            </td>
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
@endsection