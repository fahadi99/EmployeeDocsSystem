<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('type', 255);
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
        Schema::dropIfExists('file_field');
    }
}
