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
        Schema::create('survey_questions', function (Blueprint $table){
            $table->id();
            $table->integer('survey_id');
            $table->text('question');
            $table->text('additional_info');
            $table->boolean('is_optional')->default(false);
            $table->tinyInteger('status')->default(1);
            $table->smallInteger('sort_order');
            $table->enum('type', ['standard', 'single', 'multiple', 'file']);
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
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
