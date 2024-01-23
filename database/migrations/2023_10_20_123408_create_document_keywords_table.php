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
        Schema::create('document_keywords', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->string('keywords');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->default(0);
            $table->unsignedBigInteger('deleted_by')->default(0);
            $table->unsignedBigInteger('updated_by')->default(0);

            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('persons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_keywords');
    }
};
