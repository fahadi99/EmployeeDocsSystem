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
        Schema::create('document_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['start', 'in_progress', 'completed'])->default('start');
            $table->tinyInteger('is_default')->default(0);
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('document_statuses',
        function($table)
        {
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
        Schema::dropIfExists('document_statuses');
    }
};
