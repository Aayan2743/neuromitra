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
                   
                    <li class="breadcrumb-item">Add Question For Kids Assesment </li>
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
                            <h5 class="card-title">Add Question For Kids Assesment</h5>
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
                               
                                <form method="POST" action="{{ route('create_assessment.store') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-end">Select Question Section</label>

                                        <div class="col-md-6">

                                        <select class="form-select @error('questionType') is-invalid @enderror" aria-label="Default select example" id="questionType" name="questionType">
                                                <option selected disabled>Select Question Section</option>
                                                <option value="Communication Skills" {{ old('questionType') == 'Communication Skills' ? 'selected' : '' }}>Communication Skills</option>
                                                <option value="Social Skills" {{ old('questionType') == 'Social Skills' ? 'selected' : '' }}>Social Skills</option>
                                                <option value="Motor Skills" {{ old('questionType') == 'Motor Skills' ? 'selected' : '' }}>Motor Skills</option>
                                                <option value="Cognitive Skills" {{ old('questionType') == 'Cognitive Skills' ? 'selected' : '' }}>Cognitive Skills</option>
                                                <option value="Emotional and Behavioral Regulation" {{ old('questionType') == 'Emotional and Behavioral Regulation' ? 'selected' : '' }}>Emotional and Behavioral Regulation</option>
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
                                                    style="height: 100px">{{ old('Questions') }}</textarea>
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
                                                Add Question
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                       


                        </div>

                    </div>
                </div>
              
                <div class="col-xxl-12">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">List Of Questions</h5>
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
                                            <th scope="row">Question Type</th>
                                            <th>Query</th>
                                            
                                           
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        

                                    @forelse ($listofquestions as $therapist)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                   
                                                        <span class="d-block"> {{$therapist->section_name}}</span>
                                                      
                                                  
                                                </div>
                                            </td>
                                            <td>
                                                <span > {{$therapist->Q1}}</span>
                                            </td>
                                           
                                           
                                            <td>
                                               
                                                <style>
                                                    .action-buttons {
                                                        display: inline-flex;
                                                        gap: 10px; /* Adjust the gap as needed */
                                                    }
                                                </style>

                                                <div class="action-buttons">
                                                    <a href="{{ route('kids.question.update', $therapist->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                                    <form id="delete-form-{{ $therapist->id }}" action="{{ route('create_assessment.destroy', $therapist->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>

                                                                <button onclick="confirmDelete({{ $therapist->id }})" class="btn btn-danger">
                                                                    Delete
                                                                </button>


                                                    
                                                </div>   



                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No  Records Found</td>
                                        </tr>

                                        @endforelse


                                      
                                        {{-- <div class="pagination justify-content-center">
                                         
                                        </div> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center" >
                            
                           
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