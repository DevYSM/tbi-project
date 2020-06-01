<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('duration');
            $table->string('short_description');
            $table->longText('description');
            $table->string('lang_code')->index();
            $table->longText('meta_title');
            $table->longText('meta_desc');
            $table->longText('meta_keywords');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('project_translations', function (Blueprint $table) {
            $table->foreign('lang_code')->references('code')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_translations');
    }
}
