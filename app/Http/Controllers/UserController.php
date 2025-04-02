<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password.confirmed' => 'The password and confirmation password do not match.',
            'role_id'=>'required',
            'emp_code'=>'required|unique:users,emp_code',  
            'address'=>'required',
            'phone_no'=>'required|min:10',
            'gender'=>'required'
        ]);
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_name = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->role_id = $request->get('role_id');
        $user->emp_code = $request->get('emp_code');
        $user->address = $request->get('address');
        $user->phone_no = $request->get('phone_no');
        $user->gender = $request->get('gender');
        $user->modify_date = Carbon::now();
        $user->save();
        return redirect()->route('user.index')->with('message','User created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users=User::find($id);
        return view('admin.user.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $this->validate($request,[
            'email'=>'required|unique:users,email',
            'emp_code'=>'required|unique:users,emp_code', 
       
   
        ]);

        $user=User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_name = $request->email;
        $user->role_id = $request->role_id;
        $user->emp_code = $request->emp_code;
        $user->address = $request->address;
        $user->phone_no = $request->phone_no;
        $user->gender = $request->gender;
        $user->modify_date = Carbon::now();
        $user->save();
        return redirect()->route('user.index')->with('message','User Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('message','User Deleted successfully');
    }

    public function resetPassword()
    {
        return view('admin.user.resetpassword');
    }
    public function postresetPassword(Request $request)

    {
       
        $validated = $request->validate([
            'emp_code' => 'required|exists:users,emp_code',
            'password' => 'required|min:8|confirmed', 
            'password_confirmation' => 'required|min:8',
        ]);
     
            $user = User::where('emp_code',$validated['emp_code'])->first();
            if ($user) 
            {
                $user->password = Hash::make($validated['password']); 
                $user->save(); 
                return redirect()->back()->with('message', 'Password reset successfully!');
            }
            
       
        
    }


}
