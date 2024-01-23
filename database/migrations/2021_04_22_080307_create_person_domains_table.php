<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_domains', function (Blueprint $table) {
            $table->id();
            $table->integer('person_id')->nullable(false)->unsigned();
            $table->integer('domain_id')->nullable(false)->unsigned();
            $table->tinyInteger('is_current')->default(1);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('person_domains',
        function($table)
        {
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');
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
        Schema::dropIfExists('person_domains');
    }
}
