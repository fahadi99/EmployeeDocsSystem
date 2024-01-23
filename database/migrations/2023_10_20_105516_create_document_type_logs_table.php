<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_type_logs', function (Blueprint $table) {
            $table->id();

            $table->integer('document_id')->nullable(false)->unsigned();
            $table->integer('type_id')->nullable(false)->unsigned();

            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('document_type_logs',
        function($table)
        {
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('document_types')->onDelete('cascade');

            $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_type_logs');
    }
};
