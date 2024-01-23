<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteInitalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('file_fields');
        Schema::dropIfExists('file_type_fields');

        Schema::dropIfExists('folder_file_details');
        Schema::dropIfExists('folder_file_values');
        Schema::dropIfExists('folder_files');

        Schema::dropIfExists('file_types');
        Schema::dropIfExists('person_projects');

        Schema::dropIfExists('project_spaces_folders');
        Schema::dropIfExists('project_spaces');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_types');
        Schema::dropIfExists('search_data');
        Schema::dropIfExists('spaces');

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
