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
                   
                    <li class="breadcrumb-item"> Report For Adult Assement  </li>
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
              

                <div class="col-xxl-12">
                <div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Score Details</h5>
            <div>
               
            </div>
        </div>

        <div class="container mt-4">
 

        <div class="card-body">
            @forelse ($listofanswers as $key => $therapist)
                @php
                    $data = json_decode($therapist->data, true);
                    $scores = json_decode($therapist->score, true);
                    $totalScore = $scores['Total Score'] ?? 0;

                    // Dynamic Score Interpretation
                    if ($totalScore >= 41) {
                        $message = "✅ Development appears typical for age. No significant concerns.";
                        $bgColor = "bg-success";
                    } elseif ($totalScore >= 31) {
                        $message = "⚠️ Some areas of concern. Consider monitoring and engaging in activities to boost skills.";
                        $bgColor = "bg-warning";
                    } elseif ($totalScore >= 21) {
                        $message = "❗ Potential developmental delays. A professional evaluation is recommended.";
                        $bgColor = "bg-danger";
                    } else {
                        $message = "🚨 High likelihood of developmental concerns. Immediate professional consultation is advised.";
                        $bgColor = "bg-dark text-white";
                    }
                @endphp

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-user-circle text-primary"></i> Name: {{ $therapist->users->name }}</h6>
                        <span class="badge bg-info text-dark">Submitted: {{ $therapist->submission_date }}</span>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong> Patient Name:</strong> {{ $therapist->users->name }}</p>
                             
                            </div>
                          
                        </div>

                        <hr>

                        <h6 class="text-secondary"><i class="fas fa-list"></i> Assessment Details</h6>
                        @foreach ($data['answers'] as $category => $questions)
                            <div class="accordion" id="accordion{{ $loop->index }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}">
                                            {{ $category }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            @foreach ($questions as $question)
                                          
                                              @php
                                                    // Define Likert scale mapping for text-based answers
                                                    $answerMapping = [
                                                        'Strongly Disagree' => ['value' => 1, 'color' => 'bg-danger'],
                                                        'Disagree' => ['value' => 2, 'color' => 'bg-warning'],
                                                        'Neutral' => ['value' => 3, 'color' => 'bg-secondary'],
                                                        'Agree' => ['value' => 4, 'color' => 'bg-info'],
                                                        'Strongly Agree' => ['value' => 5, 'color' => 'bg-success'],
                                                    ];

                                                    // Get the answer and fallback to 'Neutral' if undefined
                                                    $answerText = $question['answer'] ?? 'Neutral';
                                                    $answerValue = $answerMapping[$answerText]['value'];
                                                    $badgeColor = $answerMapping[$answerText]['color'];
                                                @endphp

                                                <p><strong>Q:</strong> {{ $question['question'] }}</p>
                                                <p><strong>A:</strong> 
                                                    <span class="badge {{ $badgeColor }}">
                                                        {{ $answerText }} 
                                                    </span>
                                                </p>

                                               
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <h6 class="text-secondary"><i class="fas fa-chart-bar"></i> Assessment Scores</h6>
                        <div class="row">
                            @foreach ($scores as $category => $score)
                                <div class="col-md-4">
                                    <div class="p-2 border rounded bg-light text-center">
                                        <strong>{{ $category }}</strong>
                                        <h5 class="mb-0">{{ $score }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="alert {{ $bgColor }} text-center">
                            <h6 class="mb-0">{{ $message }}</h6>
                        </div>

                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No Records Found</p>
            @endforelse

            <!-- Static Score Interpretation -->
            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0">Score Interpretation Guide</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-success"><strong>41-50:</strong> ✅ Development appears typical for age. No significant concerns.</li>
                        <li class="list-group-item list-group-item-warning"><strong>31-40:</strong> ⚠️ Some areas of concern. Consider monitoring and engaging in activities to boost skills.</li>
                        <li class="list-group-item list-group-item-danger"><strong>21-30:</strong> ❗ Potential developmental delays. A professional evaluation is recommended.</li>
                        <li class="list-group-item list-group-item-dark"><strong>0-20:</strong> 🚨 High likelihood of developmental concerns. Immediate professional consultation is advised.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>


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