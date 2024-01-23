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
        Schema::table('documents', function (Blueprint $table) {
            $table->integer('department_id')->unsigned()->nullable(true)->change();
            $table->integer('domain_id')->unsigned()->nullable(true)->change();
            $table->integer('organization_id')->unsigned()->nullable(true)->change();
            $table->integer('department_id')->unsigned()->nullable(true)->change();
            $table->integer('project_id')->unsigned()->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->integer('department_id')->unsigned()->nullable(false)->change();
            $table->integer('domain_id')->unsigned()->nullable(false)->change();
            $table->integer('organization_id')->unsigned()->nullable(false)->change();
            $table->integer('department_id')->unsigned()->nullable(false)->change();
            $table->integer('project_id')->unsigned()->nullable(false)->change();
        });
    }
};
