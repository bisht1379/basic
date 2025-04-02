<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::get();
        return view('admin.role.index',compact('roles'));
    }
    public function create()
    {
        return view('admin.role.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[

            'role_name'=>'required|unique:roles,role_name',
            
        ]);

        $role= new Role();
        $role->role_name=$request->role_name;
        $role->save();
        return redirect()->route('role.index')->with('message','Role created successfully');
    }

    public function edit($id)
    {
        $role=Role::find($id);
        return view('admin.role.edit',compact('role'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'role_name'=>'required|unique:roles,role_name',
        ]);

        $role=Role::find($id);
        $role->role_name=$request->role_name;
        $role->save();
        return redirect()->route('role.index')->with('message','Role Updated successfully');
    }
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if ($role->users()->count() > 0) {
            $role->users()->delete();
        }
        $role->delete();
    
        return redirect()->route('role.index')->with('message','Role Deleted successfully');
       
    }
}
