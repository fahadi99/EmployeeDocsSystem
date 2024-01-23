<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForiegnKeyRelationOfDesignationsInPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->integer('designation_id')->nullable()->unsigned();
            $table->integer('department_id')->nullable()->unsigned();
            $table->integer('organization_id')->nullable()->unsigned();
        });

        Schema::table('persons',
        function($table)
        {
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persons', function (Blueprint $table) {
            Schema::dropColumn('designation_id');
            Schema::dropColumn('department_id');
            Schema::dropColumn('organization_id');

        });
    }
}
