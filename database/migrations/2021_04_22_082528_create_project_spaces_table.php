<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_spaces', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->nullable(false)->unsigned();
            $table->integer('space_id')->nullable(false)->unsigned();
            $table->tinyInteger('status')->default(1);
            /*
            1 stands for active 2 stands for non active
            */
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('project_spaces',
        function($table)
        {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('space_id')->references('id')->on('spaces')->onDelete('cascade');
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
        Schema::dropIfExists('project_spaces');
    }
}
