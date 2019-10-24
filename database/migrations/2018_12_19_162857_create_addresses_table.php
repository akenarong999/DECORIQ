<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('addresses', function (Blueprint $table) {

            $table->increments('id');
            $table->string('user_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('thai_city_id');
            $table->string('thai_city');
            $table->string('postal_code');
            $table->string('tel_number')->nullable();
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
        Schema::table('addresses', function (Blueprint $table) {
            //
        });
    }
}
