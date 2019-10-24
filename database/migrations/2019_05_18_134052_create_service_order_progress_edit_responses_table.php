<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOrderProgressEditResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_order_progress_edit_responses', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('service_order_progress_edit_request_id');
          $table->longText('description')->nullable();
          $table->integer('updater_user_id')->unsigned();
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
        Schema::dropIfExists('service_order_progress_edit_responses');
    }
}
