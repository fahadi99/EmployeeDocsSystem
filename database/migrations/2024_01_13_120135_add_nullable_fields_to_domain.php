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
        Schema::table('domains', function (Blueprint $table) {
            $table->string('phone', 15)->unsigned()->nullable(true)->change();
            $table->string('picture', 255)->unsigned()->nullable(true)->change();
            $table->decimal('latitude', $precision = 10, $scale = 8)->unsigned()->nullable(true)->change();
            $table->decimal('longitude', $precision = 11, $scale = 8)->unsigned()->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->string('phone', 15)->unsigned()->nullable(false)->change();
            $table->string('picture', 255)->unsigned()->nullable(false)->change();
            $table->decimal('latitude', $precision = 10, $scale = 8)->unsigned()->nullable(false)->change();
            $table->decimal('longitude', $precision = 11, $scale = 8)->unsigned()->nullable(false)->change();
        });
    }
};
