 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->mediumText('title')->nullable(false);
            $table->integer('project_type_id')->nullable(false)->unsigned();
            $table->string('api_base', 255)->nullable(false);
            $table->string('website', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            /*
            1 stands for active 2 stands for non active
            */
            $table->timestamps();
            $table->integer('created_by')->nullable(false)->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->softDeletes();
        });

        Schema::table('projects',
        function($table)
        {
            $table->foreign('created_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('project_type_id')->references('id')->on('project_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
