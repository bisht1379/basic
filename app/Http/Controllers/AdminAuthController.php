<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        // Validate the new password
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Update the password to the new one
        $user->password = bcrypt($request->get('new_password'));
        $user->tem_password = null; // Corrected the field name here
        $user->status = true;  
        $user->save();

        return redirect()->route('admin.login')->with('message', 'Password updated successfully!');
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    public function forgetPassword()
    {
        return view('admin.auth.forget');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $tempPassword = $this->generateRandomPassword();

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($tempPassword);
        $user->tem_password = $tempPassword; // Corrected the field name here
        $user->status = false; 
        $user->save();

        // Send email with temporary password
        $this->sendPasswordEmail($request->email, $tempPassword);

        return back()->with('message', 'Your new temporary password has been sent to your email!');
    }

    public function generateRandomPassword($length = 12)
    {
        return Str::random($length);
    }

    public function sendPasswordEmail($email, $tempPassword)
    {
        $data = [
            'password' => $tempPassword,
        ];

        // Send the email with the temporary password
        Mail::send('admin.auth.emails.new_password', $data, function($message) use ($email) {
            $message->to($email)
                    ->subject('Your New Temporary Password');
        });
    }

    
    public function login(Request $request)
    {
        // Validate login form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
        {
            
            $user = Auth::user();

            // Check if user has a temporary password
            if ($user->tem_password) {
                return redirect()->route('change.password')->with('isTempPassword', true);
            }

            $role = DB::table('roles')
                ->join('users', 'roles.id', '=', 'users.role_id')
                ->where('users.id', $user->id)
                ->select('roles.role_name as role_name')
                ->first();

            if ($role && $role->role_name === 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role && $role->role_name === 'User') {
                return redirect()->route('user.dashboard'); // Assuming a user dashboard route
            }
        }

        // If authentication fails
        return redirect()->route('admin.login')->withErrors(['email' => 'Invalid credentials.']);
    }
}
