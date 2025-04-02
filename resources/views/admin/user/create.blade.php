@extends('admin.layouts.master')

	@section('content')

  <div class="card mb-6" style="max-width: 100%; margin-left: 0; padding-left: 20px;">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
                </div>
                @if(Session::has('message'))
                 <div class="alert alert-success">
                {{Session::get('message')}}
                </div>
                @endif
            <div class="col-lg-12">
              <!-- General Element -->
              <div class="card mb-4">
                <div class="card-body">
                  <form action="{{route('user.store')}}" method="POST">@csrf
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Full Name</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter Your Full Name" value="{{old('name')}}">
                   
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                   
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Email address</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror "  name="email" placeholder="Enter your Email" value="{{old('email')}}">
                    
                      @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                    
                    
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Password</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" placeholder="Enter your Password" value="{{old('password')}}">
                  
                      @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                  
                  
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Confirm Password</label>
                      <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" placeholder="Enter your Confirm Password">
                   
                      @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                   
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Role</label>

                      <select class="form-control @error('role_id') is-invalid @enderror" name="role_id" >
                        <option value="">Select Role</option>
                        @foreach(App\Models\Role::all() as $role)
                        <option value="{{$role->id}}">{{$role->role_name}}</option>
                       @endforeach
                      </select>
           
                    </div>
                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror  
                
                
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Employee Code</label>
                      <input type="text" class="form-control @error('emp_code') is-invalid @enderror"  name="emp_code" placeholder="Enter your Employee Code" value="{{old('emp_code')}}">
                      @error('emp_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                   
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Address</label>
                      <input type="text" class="form-control @error('address') is-invalid @enderror"  name="address" placeholder="Enter your Address" value="{{old('address')}}">
                      @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                  
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Phone No</label>
                      <input type="number" class="form-control @error('phone_no') is-invalid @enderror"  name="phone_no" placeholder="Enter your Phone No" value="{{old('phone_no')}}">
                  
                      @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                    </div>


                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Gender</label>
                      <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                      <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      


                   
                    <button type="submit" class="btn btn-primary" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">Submit</button>
                  </form>
                </div>
              </div>
          
            </div>


</div>



@endsection