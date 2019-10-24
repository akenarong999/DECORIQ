<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('message')->nullable();
            $table->integer('service_conversations_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('service_order_id')->unsigned()->nullable();
            $table->tinyInteger('is_seen')->default(0)->unsigned();	
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
        Schema::dropIfExists('service_messages');
    }
}
