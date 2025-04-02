<?php

namespace App\Http\Controllers;
use App\Uploadpredict;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
       
        $userId=Auth::user()->id;
        $files=DB::table('uploadpredicts')
                ->where('modify_by',$userId)
                ->get();
        return view('admin.dashboard',compact('files'));  // Your admin dashboard view
    }
}
