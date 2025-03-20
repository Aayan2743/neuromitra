@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>


            <div class="card">
                <div class="card-header">{{ __('Register therapist') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('registeruser') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                    //$get_details=App\Models\appointments::all();
    
                    //dd($get_details);
                @endphp
    
    
                @forelse ($get_all_therapists as $therapist)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $loop->iteration + ($get_all_therapists->currentPage() - 1) * $get_all_therapists->perPage() }}</td> --}}
                        <td>{{$therapist->name}}</td>
                        <td>{{$therapist->email}}</td>
                      <!-- Edit Button -->
                      <td>
                            <a href="{{ route('therapists.edit', $therapist->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('therapists.destroy', $therapist->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this therapist?');">
                                    Delete
                                </button>
                            </form>
                      
                      
                        {{-- <td>9
                        {{-- @auth
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
                        @endauth --}}
                    </td> 
                    </tr>
    
                    @empty
                    <tr>
                        <td colspan="8">No Therapist Records Found</td>
                    </tr>
                    
                @endforelse

                <div class="pagination justify-content-center">
                    {{ $get_all_therapists->links('pagination::bootstrap-4') }}
                </div>
            </tbody>
        </table>

        
    </div>
</div>
@endsection
