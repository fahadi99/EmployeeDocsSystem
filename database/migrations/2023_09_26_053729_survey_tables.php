<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SurveyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table){
            $table->id();
            $table->string('name', 255);
            $table->text('short_description');
            $table->text('long_description');
            $table->date('start_date');
            $table->date('end_date')->nullable(true);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
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
