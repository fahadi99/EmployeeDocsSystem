<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSpacesFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_spaces_folders', function (Blueprint $table) {
            $table->id();
            $table->integer('project_space_id')->nullable(false)->unsigned();
            $table->string('name', 255)->nullable(false);
            $table->integer('parent_id')->default(0);
            $table->tinyInteger('public_visibility')->default(0);
            $table->datetime('dated');
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('project_spaces_folders',
        function($table)
        {
            $table->foreign('project_space_id')->references('id')->on('project_spaces')->onDelete('cascade');
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
        Schema::dropIfExists('project_spaces_folders');
    }
}
