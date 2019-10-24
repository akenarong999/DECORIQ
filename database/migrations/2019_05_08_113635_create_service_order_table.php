<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('service_order_status_id')->unsigned();
            $table->integer('service_order_billing_address_id')->unsigned()->nullable();
            $table->decimal('service_order_quote_price',8,2)->unsigned()->nullable();
            $table->decimal('service_order_discount',8,2)->unsigned()->nullable();
            $table->decimal('service_order_fee',8,2)->unsigned()->nullable();
            $table->decimal('service_order_total',8,2)->unsigned()->nullable();
            $table->longText('service_order_conclusion')->nullable();
            $table->string('service_order_hash');
            $table->string('service_order_customer_note')->nullable();
            $table->integer('service_order_revision_times')->unsigned()->nullable();
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
        Schema::dropIfExists('service_orders');
    }
}
