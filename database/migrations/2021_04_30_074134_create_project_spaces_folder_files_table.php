<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSpacesFolderFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_files', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name')->nullable(false);
            $table->mediumText('description')->nullable(false);
            $table->string('location', 255)->nullable(false);
            $table->integer('file_type_id')->nullable(false)->unsigned();
            $table->integer('project_space_folder_id')->nullable(false)->unsigned();
            // just for quick purpose might not use it.
            $table->integer('project_space_id')->nullable()->unsigned();

            $table->tinyInteger('public_visibility')->default(0);
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('folder_files',
        function($table)
        {
            $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('file_type_id')->references('id')->on('file_types')->onDelete('cascade');
            $table->foreign('project_space_folder_id')->references('id')->on('project_spaces_folders')->onDelete('cascade');
            $table->foreign('project_space_id')->references('id')->on('project_spaces')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
        });



        Schema::create('folder_file_details', function (Blueprint $table) {
            $table->id();
            $table->integer('folder_file_id')->nullable(false)->unsigned();
            $table->string('location', '255');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });


        Schema::table('folder_file_details',

        function($table)
        {
            $table->foreign('folder_file_id')->references('id')->on('folder_files')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_spaces_folder_files');
    }
}
