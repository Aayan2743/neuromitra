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
                   
                    <li class="breadcrumb-item">List Of Adults Assements</li>
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
                            <h5 class="card-title">List Of Results</h5>
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
                                            <th scope="row">Parent Name</th>
                                         
                                          
                                           
                                            <th scope="row">Date of Submission</th>
                                          
                                            
                                           
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        

                                    

                                    @forelse ($listofanswers as $key=> $therapist)
                                       
                                       @php
                                         $data = json_decode($therapist->data, true);
                                        
                                       @endphp

                                          
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$therapist->users->name}}</td>
                                           
                                            <td>{{$therapist->submission_date}}</td>
                                            <td><a href="{{route('adults.result.id',$therapist->id)}}">View </a></td>
                                          
                                            
                                          
                                           
                                           
                                           
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