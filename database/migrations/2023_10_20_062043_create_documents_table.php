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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->text('subject');
            $table->text('short_description')->nullable(true);
            $table->text('description')->nullable(true);
            $table->datetime('dated');

            $table->integer('domain_id')->default(0)->unsigned();
            $table->integer('organization_id')->default(0)->unsigned();
            $table->integer('department_id')->default(0)->unsigned();
            $table->integer('owner_id')->nullable(false)->unsigned();
            $table->integer('document_status_id')->nullable(false)->unsigned();
            $table->tinyInteger('is_restricted')->default(0);
            $table->integer('priority_id')->nullable(false)->unsigned();
            $table->integer('document_type_id')->nullable(false)->unsigned();
            $table->integer('project_id')->default(0)->unsigned();

            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('documents',
        function($table)
        {
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->foreign('owner_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('document_status_id')->references('id')->on('document_statuses')->onDelete('cascade');
            $table->foreign('priority_id')->references('id')->on('document_priorities')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');

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
        Schema::dropIfExists('documents');
    }
};
