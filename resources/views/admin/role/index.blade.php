@extends('admin.layouts.master')

@section('content')
<div class="col-xl-8 col-lg-7 mb-4">

@if(Session::has('message'))

<div class="alert alert-success">
  {{Session::get('message')}}

</div>
@endif
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="{{route('role.create')}}" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">ADD ROLE</a>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>S.NO</th>
                        <th>Role Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($roles)>0)
                    @foreach($roles as $key=>$role)

                      <tr>
                        <td><a href="#">{{$key+1}}</a></td>
                        <td>{{$role->role_name}}</td>
                        <td><a href="{{route('role.edit',[$role->id])}}" class="btn btn-sm btn-success" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">Edit</a></td>
                      <td>
                        <form action="{{route('role.destroy',[$role->id])}}" method="POST" onsubmit="return confirmDelete() ">@csrf
                          <button class="btn btn-sm btn-danger">Delete</button>

                        </form>
                      </td>


                      </tr>
                  
                    </tbody>

                    @endforeach 
                    @else
                    <td>No Roles to display</td>
                    @endif
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>

@endsection