<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->unique();
          $table->string('description')->nullable();
          $table->string('slug');
          $table->integer('category_id')->unsigned()->nullable();
          $table->integer('profile_photo')->unsigned()->nullable();
          $table->integer('cover_photo')->unsigned()->nullable();
          $table->integer('icon_photo')->unsigned()->nullable();
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
        Schema::dropIfExists('service_categories');
    }
}
