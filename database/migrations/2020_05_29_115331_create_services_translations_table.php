<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->string('lang_code')->index();
            $table->longText('meta_title');
            $table->longText('meta_desc');
            $table->longText('meta_keywords');
            $table->unsignedBigInteger('services_id');
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('services_translations', function (Blueprint $table) {
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
        Schema::dropIfExists('services_translations');
    }
}
