@extends('admin.layouts.master')

@section('content')
<div class="col-xl-12 col-lg-8 mb-4">

@if(Session::has('message'))

<div class="alert alert-success">
  {{Session::get('message')}}

</div>
@endif
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All User</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="{{route('user.create')}}" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">ADD USER</a>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>S.NO</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>User Name</th>
                        <th>Employee Code</th>
                        <th>Address</th>
                        <th>Phone No</th>
                        <th>Role Name</th>
                        <th>Gender</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($users)>0)
                    @foreach($users as $key=>$user)

                      <tr>
                        <td><a href="#">{{$key+1}}</a></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>   
                        <td>{{$user->user_name}}</td>   
                        <td>{{$user->emp_code}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->phone_no}}</td>
                        <!-- <td> {{ optional($user->role)->role_name ?? 'No role available' }}</td> -->
                        <td>{{$user->role->role_name}}</td>
                        <td>{{$user->gender}}</td>
                        <td><a href="{{route('user.edit',[$user->id])}}" class="btn btn-sm btn-success" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">Edit</a></td>
                      <td>
                        <form action="{{route('user.destroy',[$user->id])}}" method="POST" onsubmit="return confirmDeleteUser() ">@csrf
                          {{method_field('DELETE')}}
                          <button class="btn btn-sm btn-danger">Delete</button>

                        </form>
                      </td>


                      </tr>
                  
                    </tbody>

                    @endforeach 
                    @else
                    <td>No users to display</td>
                    @endif
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>

@endsection