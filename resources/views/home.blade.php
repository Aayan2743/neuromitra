@extends('layouts.app')

<style>
    .filters {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem; /* Adjust the spacing between elements */
}

.filter-group {
    flex: 1;
    min-width: 200px; /* Minimum width for each filter group */
}


    </style>

@section('content')



<div class="containe" style="min-width:200px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                

                    
                <form method="GET" action="{{ route('users.index') }}" class="mb-4">
    <!-- <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}">
    </div> -->

    <div class="form-group mt-3 filters">
        <div class="filter-group">
            <label for="appointment_type">Appointment Type</label>
            <div>
                <input type="radio" id="online" name="appointment_type" value="online" 
                       {{ request('appointment_type') == 'online' ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label for="online">Online</label>

                <input type="radio" id="offline" name="appointment_type" value="offline" 
                       {{ request('appointment_type') == 'offline' ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label for="offline">Offline</label>
            </div>
        </div>

        <div class="filter-group">
            <label for="appointment_status">Appointment Status</label>
            <div>
                <input type="radio" id="confirmed" name="appointment_status" value="closed"
                       {{ request('appointment_status') == 'closed' ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label for="confirmed">Closed</label>

                <input type="radio" id="pending" name="appointment_status" value="opened"
                       {{ request('appointment_status') == 'opened' ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label for="pending">Opened</label>

                <!-- <input type="radio" id="cancelled" name="appointment_status" value="cancelled"
                       {{ request('appointment_status') == 'cancelled' ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label for="cancelled">Cancelled</label> -->
            </div>
        </div>

        <div class="filter-group">
            <a href="{{ route('home') }}" class="btn btn-secondary">Refresh</a>
        </div>
    </div>
</form>



    <!-- <button type="submit" class="btn btn-primary mt-2">Filter</button> -->

</form>

     <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Appointment Type</th>
                <th>Date Of Appointment</th>
                <th>Location</th>
                <th>Soure</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                //$get_details=App\Models\appointments::all();

                //dd($get_details);
            @endphp


            @forelse ($get_details as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    {{-- <td>{{ $loop->iteration + ($get_details->currentPage() - 1) * $get_details->perPage() }}</td> --}}
                    <td>{{ $user->Full_Name }}</td>
                    <td>{{ $user->phone_Number }}</td>
                  
                    <td>{{ $user->age}}</td>
                    <td>{{ $user->appointment_type == 1 ? 'Online' : 'Offline'  }}</td>
                    <td>{{ $user->Date_of_appointment }}</td>
                    <td>{{ $user->location }}</td>
                    <td>{{ $user->page_source }}</td>
                    <td>
                    @auth
                    @if(Auth()->user()->user_type==2)
                    @php
                    // Retrieve the therapist by user ID
                    // $therapist = App\Models\User::find(Auth::id());
                    // $therapist = App\Models\User::where('id',$user->therapist_id)->get();
                    // $therapist = App\Models\User::find($user->therapist_id);    
                    $therapist = App\Models\User::find($user->therapist_id);
                        // Ensure therapist exists
                        $therapist_name = $therapist ? $therapist->name : 'Therapist not found';
                    
                @endphp
            
                {{-- Display the therapist's name --}}
                <p> {{ $therapist_name }}</p>  



                            {{-- Name Will come here --}}
                        @else
                        <form action="{{ route('appointments.changeStatus', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            @if($user->appointment_status=='1')
                                {{'Appointment Closed'}}    
                            @else
                                <button type="submit" class="btn btn-warning">
                            X
                            </button>
                            @endif
                            
                        </form>
                        @endif
                    @endauth
                </td>
                </tr>

                @empty
                <tr>
                    <td colspan="8">No appointments found</td>
                </tr>
                
            @endforelse

            <div class="pagination justify-content-center">
                {{ $get_details->links('pagination::bootstrap-4') }}
            </div>
        </tbody>
    </table>


                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
