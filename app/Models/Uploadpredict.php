<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadpredict extends Model
{
    use HasFactory;
    
    protected $table = 'uploadpredicts'; 
    protected $fillable=['complaint_file_name','complaint_file_path','result_file_name','result_file_path','create_date','modify_by','modify_date'];

}
