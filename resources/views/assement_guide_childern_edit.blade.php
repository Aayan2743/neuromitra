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
                   
                    <li class="breadcrumb-item">Update Question For Kids Assesment </li>
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
                            <h5 class="card-title">Update Question For Kids Assesment</h5>
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
                               
                                <form method="POST" action="{{ route('create_assessment.update',$listofquestions[0]->id) }}">
                                    @csrf
                                    @Method('patch')
                                      <input type="hidden" id="sid" name="sname" value="{{$listofquestions[0]->id}}"  /> 
                                    <div class="row mb-3">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-end">Select Question Section</label>

                                        <div class="col-md-6">

                                        @php
                                                    // List of static sections
                                                    $sections = [
                                                        "Communication Skills",
                                                        "Social Skills",
                                                        "Motor Skills",
                                                        "Cognitive Skills",
                                                        "Emotional and Behavioral Regulation"
                                                    ];

                                                    // Get the selected value from the database (passed from the controller)
                                                    $selectedSection = old('questionType', $listofquestions[0]->section_name ?? '');
                                                @endphp

                                                <select class="form-select @error('questionType') is-invalid @enderror" 
                                                        aria-label="Select Question Section" 
                                                        id="questionType" 
                                                        name="questionType">
                                                    <option selected disabled>Select Question Section</option>

                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section }}" 
                                                            {{ $selectedSection == $section ? 'selected' : '' }}>
                                                            {{ $section }}
                                                        </option>
                                                    @endforeach
                                                </select>                                      




                                            @error('questionType')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        


                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">Question </label>

                                        <div class="col-md-6">
                                        <div class="form-floating">
                                            <textarea class="form-control @error('Questions') is-invalid @enderror" 
                                                   
                                                    id="Questions" 
                                                    name="Questions" 
                                                    style="height: 100px">{{$listofquestions[0]->Q1  }}</textarea>
                                            <label for="Questions">Write Your Question Here</label>
                                        </div>

                                        @error('Questions')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    </div>

                                  

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Update Question
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
    }).then((result) => {
         
           //return false; 
         

        if (result) {
            // Send the delete request via AJAX
            var form = document.getElementById('delete-form-' + id);
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body:  formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'Deleted!',
                        'The Question has been deleted.',
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
        } else {
            // Optionally, you can handle the Cancel case here if needed
            Swal.fire(
                'Cancelled',
                'The Question is safe :)',
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