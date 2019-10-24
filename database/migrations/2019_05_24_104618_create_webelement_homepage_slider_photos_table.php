<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebelementHomepageSliderPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webelement_homepage_slider_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('link')->nullable();
            $table->string('photo_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webelement_homepage_slider_photos');
    }
}
