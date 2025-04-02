<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin= new User();
        $admin->name="admin";
        $admin->email="admin@gmail.com";
        $admin->password = Hash::make('password');
        $admin->email_verified_at=Now();
    	$admin->address="Australia";
    	$admin->phone_no="1234567890";
        $admin->gender="Male";
        $admin->role_id=1;
        $admin->modify_date=Carbon::now();
        $admin->status=1;
        $admin->emp_code='Admin1';
        $admin->user_name="admin@gmail.com";
        $admin->save();

        $admin= new User();
        $admin->name="user";
        $admin->email="user@gmail.com";
        $admin->password = Hash::make('password');
        $admin->email_verified_at=Now();
    	$admin->address="Australia";
    	$admin->phone_no="1234567890";
        $admin->gender="Male";
        $admin->user_name="user@gmail.com";
        $admin->role_id=2;
        $admin->modify_date=Carbon::now();
        $admin->status=1;
        $admin->emp_code='user1';
        $admin->save();


        $admin= new User();
        $admin->name="sales";
        $admin->email="sale@gmail.com";
        $admin->password = Hash::make('password');
        $admin->email_verified_at=Now();
    	$admin->address="Australia";
    	$admin->phone_no="1234567890";
        $admin->gender="Male";
        $admin->user_name="sale@gmail.com";
        $admin->role_id=3;
        $admin->modify_date=Carbon::now();
        $admin->status=1;
        $admin->emp_code='sales';
        $admin->save();
        $adminRole = Role::create([
        'role_name'=>'Admin',
        'modify_date'=>Carbon::now(),
        'status'=>1,
        ]);
        $userRole = Role::create([
            'role_name'=>'User',
            'modify_date'=>Carbon::now(),
            'status'=>1,
            ]);

    }
}
