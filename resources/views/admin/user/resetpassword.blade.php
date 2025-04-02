@extends('admin.layouts.master')

@section('content')

   
<div class="col-lg-6">
        <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Reset Password</h6>
                </div>
        @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('user.reset.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="emp_code">Select User</label>
                    <select class="form-control @error('emp_code') is-invalid @enderror" name="emp_code">
                        <option value="">Select User</option>
                        @foreach(App\Models\User::all() as $user)
                        <option value="{{ $user->emp_code }}" {{ old('emp_code') == $user->emp_code ? 'selected' : '' }}>
                            {{ $user->user_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('emp_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your Password" value="{{ old('password') }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group"  >
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm your Password">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
