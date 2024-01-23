<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangetoFolderFileDetailPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folder_file_details', function (Blueprint $table){
            $table->dropColumn('location');
            $table->dropColumn('start');
            $table->dropColumn('end');
            $table->dropColumn('ext');
            $table->dropColumn('name');
            $table->dropColumn('file_id');
            $table->text('folder_file_data')->nullable(false);
            $table->enum('type', ['data', 'file', 'both']);

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
