@extends('admin.layouts.master')
@section('title','Create Role')
@section('content')

<div class="card mb-4" style="width:50%; margin-left:40px;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Role</h6>
                </div>
                <div class="card-body">
                  <form action="{{route('role.update',[$role->id])}}" method="POST">@csrf
              

                    <div class="form-group">
                      <label for="">Role Name</label>
                      <input type="text" class="form-control @error('role_name') is-invalid @enderror"  placeholder="Enter name" name="role_name" value="{{$role->role_name}}">
                      @error('role_name')
                      <span class="invalid-feedbak">
                        <strong>{{$message}}</strong>

                      </span>
                    @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">Update</button>
                  </form>
                </div>
              </div>

@endsection