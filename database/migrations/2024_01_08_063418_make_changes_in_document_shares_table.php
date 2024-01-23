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
        Schema::table('document_shares', function (Blueprint $table) {
            $table->dropForeign('document_shares_deleted_by_foreign');
            $table->dropColumn('deleted_by');
            $table->dropForeign('document_shares_updated_by_foreign');
            $table->dropColumn('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_shares', function (Blueprint $table) {
            $table->unsignedBigInteger('deleted_by')->default(0)->change();
            $table->unsignedBigInteger('updated_by')->default(0)->change();
        });
    }
};
