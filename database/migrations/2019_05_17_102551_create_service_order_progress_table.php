<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOrderProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_order_progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_order_id')->unsigned();
            $table->integer('service_order_progress_status_id')->unsigned();
            $table->integer('updater_user_id')->unsigned();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('service_order_progresses');
    }
}
