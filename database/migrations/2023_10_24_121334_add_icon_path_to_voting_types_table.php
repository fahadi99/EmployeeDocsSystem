<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIconPathToVotingTypesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('voting_types', function (Blueprint $table) {
            $table->string('icon_path')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voting_types', function (Blueprint $table) {
            $table->dropColumn('icon_path');
        });
    }
}
