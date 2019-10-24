<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProofOfPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_proof_of_payments', function (Blueprint $table) {
          $table->increments('id');
          $table->string('order_id');
          $table->string('payment_method_id');
          $table->float('amount');
          $table->string('key')->nullable();
          $table->string('photo_id')->nullable();
          $table->string('user_id')->nullable();
          $table->dateTime('payment_datetime');
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
        Schema::dropIfExists('order_proof_of_payments');
    }
}
