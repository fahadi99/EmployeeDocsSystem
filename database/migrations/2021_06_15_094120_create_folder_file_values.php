<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderFileValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_file_values', function (Blueprint $table) {
            $table->id();
            $table->integer('folder_file_id');
            $table->integer('file_field_id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by');
            $table->integer('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folder_file_values');
    }
}
