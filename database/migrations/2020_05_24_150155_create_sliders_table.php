<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->text('photo');
            $table->integer('status')->default(0);
            $table->string('lang_code')->index(); // Index To Create The Relationship
            $table->timestamps();
        });

        Schema::table('sliders', function (Blueprint $table) {
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
        Schema::dropIfExists('sliders');
    }
}
