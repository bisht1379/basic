<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_name')->unique();
            $table->string('emp_code')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('gender');
            $table->unsignedBigInteger('role_id');  
            $table->timestamp('modify_date')->nullable(); 
            $table->string('tem_password')->nullable();
            $table->timestamps();  
            $table->boolean('status')->default(true);  
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
