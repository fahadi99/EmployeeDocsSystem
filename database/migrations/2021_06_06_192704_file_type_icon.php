<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FileTypeIcon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folder_file_details', function (Blueprint $table) {
            $table->string('ext', 20)->nullable(true);
        });

        Schema::table('folder_files', function (Blueprint $table) {
            $table->string('ext', 20)->nullable(true);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
