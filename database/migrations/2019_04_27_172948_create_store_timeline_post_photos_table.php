<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTimelinePostPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_timeline_post_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_timeline_post_id')->unsigned()->nullable(); // where post available.
            $table->integer('photo_id')->unsigned()->nullable();
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
        Schema::dropIfExists('store_timeline_post_photos');
    }
}
