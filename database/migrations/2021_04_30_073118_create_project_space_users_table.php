<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSpaceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('project_space_users', function (Blueprint $table) {
//            $table->id();
//            $table->integer('project_space_id')->nullable(false)->unsigned();
//            $table->integer('user_id')->nullable(false)->unsigned();
//            $table->tinyInteger('status')->default(1);
//            /*
//            1 stands for active 2 stands for non active
//            */
//            $table->timestamps();
//            $table->integer('created_by')->nullable(false)->unsigned();
//            $table->integer('deleted_by')->nullable()->unsigned();
//            $table->softDeletes();
//        });
//
//        Schema::table('project_space_users',
//        function($table)
//        {
//            $table->foreign('project_space_id')->references('id')->on('project_spaces')->onDelete('cascade');
//            $table->foreign('user_id')->references('id')->on('persons')->onDelete('cascade');
//            $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
//            $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('project_space_users');
    }
}
