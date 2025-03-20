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
                    <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                    <li class="breadcrumb-item">Dashboard</li>
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
                            <h5 class="card-title">Search Client</h5>
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
                       
                        <div class="text-center my-3">
                            <form action="#" method="GET" class="d-inline-flex">
                                <input type="text" name="query" placeholder="Search Client..." class="form-control me-2" required>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>appointment</th>
                                   
                                        <th>Age</th>
                                        <th>Type</th>
                                        <th>Appointment For</th>
                                        <th>Date Of Appointment</th>
                                        <th>Location</th>
                                        <th>Soure</th>
                                        <th>File</th>


                                      

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($appoitment))
                                        @foreach($appoitment as $client)
                                        @php
                                       // dd($client);
                                        @endphp

                                            <tr>
                                                <td>{{ $client->id}}</td> <!-- Assuming pid is the column name -->
                                                <td>{{ $client->Full_Name }}</td> <!-- Assuming pname is the column name -->
                                                <td>{{ $client->phone_Number }}</td> <!-- Assuming p_location is the column name -->
                                                <td>{{ $client->appointment }}</td> <!-- Assuming p_location is the column name -->
                                                <td>{{ $client->age }}</td> <!-- Assuming p_location is the column name -->
                                                <td>{{ $client->appointment_type }}</td> <!-- Assuming p_location is the column name -->
                                                <td>{{ $client->Date_of_appointment }}</td> <!-- Assuming p_location is the column name -->
                                                <td>{{ $client->location }}</td> <!-- Assuming p_location is the column name -->
                                                <td>{{ $client->page_source }}</td> <!-- Assuming p_location is the column name -->
                                               
                                               
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No clients found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>


                    </div> 
                <div class="filter-group ms-5 mt-2">
                  
                </div>
            </div>
            </form>
          
        </div>
        <div class="card-footer">
         
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