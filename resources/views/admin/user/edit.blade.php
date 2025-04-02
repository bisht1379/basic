@extends('admin.layouts.master')

	@section('content')

    <div class="card mb-6" style="width:70%; margin-left:80px;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" >Edit User</h6>
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
                  <form action="{{route('user.update',[$users->id])}}" method="POST">
                  @csrf 
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Full Name</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter Your Full Name" value="{{$users->name}}">
                   
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                   
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Email address</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror "  name="email" placeholder="Enter your Email" value="{{$users->email}}">
                    
                      @error('email')
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
                        <option value="{{$role->id}}" @if($role->id==$users->role_id) selected @endif>{{$role->role_name}}</option>
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
                      <input type="text" class="form-control @error('emp_code') is-invalid @enderror"  name="emp_code" placeholder="Enter your Employee Code" value="{{$users->emp_code}}">
                      @error('emp_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                   
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Address</label>
                      <input type="text" class="form-control @error('address') is-invalid @enderror"  name="address" placeholder="Enter your Address" value="{{$users->address}}">
                      @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                  
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Phone No</label>
                      <input type="number" class="form-control @error('phone_no') is-invalid @enderror"  name="phone_no" placeholder="Enter your Address" value="{{$users->phone_no}}">
                  
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
            <option value="Male" {{ old('gender', $users->gender) == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender', $users->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                      </select>
                    </div>
                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      


                   
                    <button type="submit" class="btn btn-primary" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">UPDATE</button>
                  </form>
                </div>
              </div>
          
            </div>






@endsection