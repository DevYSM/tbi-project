<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTechnologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_technology', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('technology_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();
        });
        Schema::table('project_technology', function (Blueprint $table) {
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_technologies');
    }
}
