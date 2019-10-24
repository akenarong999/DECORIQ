<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingWeightbasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_weightbases', function (Blueprint $table) {
          $table->increments('id');
          $table->float('minweight',4,2)->nullable();
          $table->float('maxweight',4,2)->nullable();
          $table->integer('cost')->nullable();
          $table->string('shipping_id')->nullable();
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
        Schema::dropIfExists('shipping_weightbases');
    }
}
