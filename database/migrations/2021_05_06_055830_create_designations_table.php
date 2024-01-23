<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->tinyInteger('status')->default(1);
            /*
            1 stands for active 2 stands for non active
            */
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('designations',
        function($table)
        {
            $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
        });

        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->tinyInteger('status')->default(1);
            /*
            1 stands for active 2 stands for non active
            */
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('organizations',
            function($table)
            {
                $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
                $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
            });


        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->integer('parent_id')->default(0);
            $table->tinyInteger('status')->default(1);
            /*
            1 stands for active 2 stands for non active
            */
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('departments',
            function($table)
            {
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
        Schema::dropIfExists('designations');
    }
}
