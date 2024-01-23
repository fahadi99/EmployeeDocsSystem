<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name')->nullable(false);
            $table->mediumText('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('picture', 255)->nullable();
            $table->decimal('latitude', $precision = 10, $scale = 8)->nullable();
            $table->decimal('longitude', $precision = 11, $scale = 8)->nullable();
            $table->tinyInteger('status')->default(1);
            /*
            1 stands for active 2 stands for non active
            */
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('domains',
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
        Schema::dropIfExists('domains');
    }
}
