<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProjectRightAKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('person_rights',
            function($table)
            {
                $table->dropForeign(['person_id']);
                $table->dropForeign(['created_by']);
                $table->dropForeign(['deleted_by']);

                $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
                $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
            });

    }
}
