<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Uploadpredict;
use Carbon\Carbon; 
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {

        $id = Auth::user()->id;
		$adminData = User::find($id);
        return view ('admin.user.dashboard',compact('adminData'));
    }
    public function store(Request $request)
    {
      
        $userid = Auth::user()->id;
        $request->validate([
            'complaint_file' => 'required|file|mimes:xlsx,pdf,docx|max:50000',  
       
        ]);

     if ($request->hasFile('complaint_file')) {
        $complaintFile = $request->file('complaint_file');
        $originalFileName = $complaintFile->getClientOriginalName();
        $fileInfo = pathinfo($originalFileName);
        $fileNameWithoutExtension = $fileInfo['filename'];
        $fileExtension = $fileInfo['extension'];
        $date = Carbon::now()->format('d-m-y_H-i-s'); 
        $complaintFileName =  $fileNameWithoutExtension . '_' . $date .'.' . $fileExtension; 
        $complaintFilePath = $complaintFile->storeAs('public/uploads/input_directory', $complaintFileName);
        $fileUrl = Storage::url($complaintFilePath);
        
        $uploadPredict = new Uploadpredict();
        $uploadPredict->complaint_file_name = $complaintFileName ?? null;  
        $uploadPredict->complaint_file_path = $fileUrl; 
        $uploadPredict->create_date = now();  
        $uploadPredict->modify_by =$userid ;  
        $uploadPredict->modify_date = now();  
        $uploadPredict->save(); 
    }
     

        session()->flash('file', [
            'fileName' => $complaintFileName,
            'filePath' => $fileUrl,
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'File uploaded and data saved successfully!');
        return redirect()->route('admin.dashboard')->with('error', 'No file uploaded.');
    }
    public function storePredictionResult(Request $request)
    {
        $validated = $request->validate([
            'file_id' => 'required|integer',  
            'result_file_path' => 'required',  
        ]);
    
        try {
            $uploadPredict = Uploadpredict::find($request->file_id); 
            if (!$uploadPredict) {
                return response()->json(['error' => 'File not found.'], 404);
            }
    
            $uploadPredict->result_file_path = $request->result_file_path;
            $uploadPredict->save();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function delete($id)
    {
        $file = Uploadpredict::findOrFail($id);
        if (Storage::exists('public/' . $file->complaint_file_path)) {
            Storage::delete('public/' . $file->complaint_file_path);
        }
        $file->delete();
        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
