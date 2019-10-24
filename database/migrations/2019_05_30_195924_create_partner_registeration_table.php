<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerRegisterationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_registeration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('telnumber')->nullable();
            $table->string('email');
            $table->string('storename');
            $table->longText('description')->nullable();
            $table->integer('photo_1')->nullable();
            $table->integer('photo_2')->nullable();
            $table->integer('photo_3')->nullable();
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
        Schema::dropIfExists('partner_registeration');
    }
}
