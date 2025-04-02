<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadpredictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploadpredicts', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_file_name'); 
            $table->string('complaint_file_path');
            $table->string('result_file_name')->nullable();
            $table->string('result_file_path')->nullable();
            $table->timestamp('create_date')->nullable();  
            $table->string('modify_by')->nullable();  
            $table->timestamp('modify_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploadpredicts');
    }
}
