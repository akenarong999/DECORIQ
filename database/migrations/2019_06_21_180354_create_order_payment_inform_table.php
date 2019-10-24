<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPaymentInformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payment_inform', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('email');
            $table->float('paymentamount',8,2);
            $table->string('paymentdate');
            $table->string('paymenttime');
            $table->longText('paymentinformnote')->nullable();
            $table->integer('photo_1')->nullable();
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
        Schema::dropIfExists('order_payment_inform');
    }
}
