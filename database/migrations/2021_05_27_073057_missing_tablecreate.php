<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MissingTablecreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_rights', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable(false);
            $table->integer('type_id')->nullable(false);
            $table->string('slug', 255)->nullable(false);
            $table->integer('person_id')->nullable(false)->unsigned();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->tinyInteger('is_current')->default(1);
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('project_rights',
            function($table)
            {
                $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
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
        //
    }
}
