<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('type');
          $table->string('cost')->nullable();
          $table->string('store_id');
          $table->string('photo_id')->nullable();
          $table->string('allowlocations')->nullable();
          $table->string('notallowlocations')->nullable();
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
        Schema::dropIfExists('shippings');
    }
}
