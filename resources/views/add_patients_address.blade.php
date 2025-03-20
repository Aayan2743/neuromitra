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
                    <li class="breadcrumb-item"><a href="{{route('add.addpatient')}}">Add Booking</a></li>
                    <li class="breadcrumb-item">Add address</li>
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
                            <h5 class="card-title">Add My Address</h5>
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

                                <form method="POST" action="{{route('adduseraddressdetails',request()->id)}}">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                          
                                          <div class="col-xs-12 col-sm-4">
                                            <div class="box">
                                                <label for="addresstype" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Select Address Type ') }}</label>
                                                <div class="row mb-3">
                                                  
                                                    <div class="col-md-12">
                                                        <select id="addresstype" class="form-control  @error('addresstype') is-invalid @enderror" name="addresstype" required>
                                                            <option value="">Select Name</option>
                            
                                                         
                                                         
                                                           
                                                            <option value="0" >Present</option>
                                                            <option value="1" >Permanent</option>
                                                           
                                                          
                                                           
                                                         
                                                            <!-- Add more options as needed -->
                                                        </select>
                                                
                                                        @error('addresstype')
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
                                                <label for="flatno" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Flat No') }}</label>
                                                <input id="flatno" type="text" class=" form-control @error('flatno') is-invalid @enderror" name="flatno" value="{{ old('flatno') }}" required autocomplete="name" autofocus>
                                                @error('flatno')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                          </div>
                                          
                                          <div class="col-xs-12 col-sm-4">
                                            <div class="box">
                                                <label for="street" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Street') }}</label>
                                                <input id="street" type="text" class=" form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="name" autofocus>
                                                @error('street')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                          </div>
                                          
                                        </div>
                                        <div class="row">

                                            <div class="col-xs-12 col-sm-4">
                                                <div class="box">
                                                    <label for="area" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Area') }}</label>
                                                    <input id="area" type="text" class=" form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}" required autocomplete="name" autofocus>
                                                    @error('area')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                              </div>
                                          
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="box">
                                                    <label for="landmark" style="padding-left: 0;" class="col-md-4 col-form-label ms-0">{{ __('Landmark') }}</label>
                                                    <input id="landmark" type="text" class=" form-control @error('landmark') is-invalid @enderror" name="landmark" value="{{ old('landmark') }}" required autocomplete="name" autofocus>
                                                    @error('landmark')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-4">
                                              <div class="box">
                                                  <label for="pincode" style="padding-left: 0;" class="col-md-12 col-form-label ms-0">{{ __('pincode') }}</label>
                                                  <input id="pincode" type="text" class=" form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}" required autocomplete="name" autofocus>
                                                  @error('pincode')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                                  @enderror
                                              </div>
                                            </div>
                                            
                                           
                                            
                                        </div>
                                        
                                  
                            
                                         </div>
                            
                                    <button type="submit" class="btn btn-primary">Add Address</button>
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
                            <h5 class="card-title">My Family Address</h5>
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
                                            <th scope="row"> Address Type</th>
                                            <th>Flat No</th>
                                            <th>Street</th>
                                            <th>Area</th>
                                            <th>Land Mark</th>
                                            <th>Pincode</th>
                                            
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($get_my_address as $therapist)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    {{-- <div class="avatar-image">
                                                        <img src="{{asset('assets/images/avatar/2.png')}}" alt=""
                                                            class="img-fluid" />
                                                    </div> --}}
                                                        <span class="d-block"> {{$therapist->type_of_address == 0 ? 'Present' : 'Permanent'}}</span>
                                                        {{-- <span class="fs-12 d-block fw-normal text-muted"><span class="__cf_email__" data-cfemail="6e0f1c0d070b401a01000b1d2e09030f0702400d0103">[email&#160;protected]</span></span> --}}
                                                </div>
                                            </td>
                                            <td>
                                                <span > {{$therapist->Flat_no}}</span>
                                            </td>

                                            <td>
                                                <span > {{$therapist->street}}</span>
                                            </td>

                                            <td>
                                                <span > {{$therapist->area}}</span>
                                            </td>

                                            <td>
                                                <span > {{$therapist->landmark}}</span>
                                            </td>

                                            <td>
                                                <span > {{$therapist->pincode}}</span>
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

  @if (session('error'))
  <script>
      Swal.fire({
          icon: 'error',
          title: 'error!',
          text: '{{ session('error') }}',
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