<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255)->nullable(false);
            $table->string('last_name', 255)->nullable(false);
            $table->string('email', 255)->nullable(false);
            $table->string('password', 255)->nullable(false);
            $table->string('phone', 15)->nullable();
            /*non mandatory but better to have*/
            $table->string('picture', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            /*
            1 stands for active 2 stands for non active
            */
            $table->tinyInteger('person_type')->default(1);
            /*
            1 stand for member
            2 stand for admin
            3 stand for superadmin
            */
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('created_by')->default(0);
            $table->integer('deleted_by')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
