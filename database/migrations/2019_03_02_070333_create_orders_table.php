<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable;
            $table->string('order_email');
            $table->string('order_shipping_address_id');
            $table->string('order_billing_address_id');
            $table->string('order_status_id');
            $table->string('order_store_id');
            $table->string('order_discount');
            $table->string('order_fee');
            $table->string('order_total');
            $table->string('order_hash');
            $table->string('order_note')->nullable;
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
        Schema::dropIfExists('orders');
    }
}
