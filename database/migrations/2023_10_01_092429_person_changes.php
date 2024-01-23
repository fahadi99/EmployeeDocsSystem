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
        Schema::table('persons', function (Blueprint $table){
            $table->string('emp_no', 10)->nullable(true);;
            $table->enum('contract_type', ['Permanent', 'Contract'])->default('Contract');
            $table->enum('gender', ['Female', 'Male'])->default('Male');
            $table->date('doa')->nullable(true);
            $table->string('temp_password', 255)->nullable(true);
            $table->string('initial', 20)->default('Mr.');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
