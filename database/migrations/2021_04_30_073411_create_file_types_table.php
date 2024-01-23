<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->tinyInteger('multiple_allowed');
            $table->integer('space_id')->nullable(false)->unsigned();
            $table->tinyInteger('status')->default(1);
            /*
            1 stands for active 2 stands for non active
            */
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });


        Schema::table('file_types',
        function($table)
        {
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
        Schema::dropIfExists('file_types');
    }
}
