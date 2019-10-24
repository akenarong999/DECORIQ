<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_addresses', function (Blueprint $table) {
          $table->increments('id');
          $table->string('store_id');
          $table->string('address1');
          $table->string('address2')->nullable;
          $table->string('thai_city_id');
          $table->string('thai_city');
          $table->string('postal_code');
          $table->string('tel_number')->nullable;
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
        Schema::dropIfExists('store_addresses');
    }
}
