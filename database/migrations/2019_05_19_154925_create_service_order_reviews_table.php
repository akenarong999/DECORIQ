<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOrderReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_order_reviews', function (Blueprint $table) {
          $table->increments('id');
          $table->string('service_order_id');
          $table->string('service_id');
          $table->string('service_name')->nullable();
          $table->string('rating');
          $table->longText('review_message')->nullable();
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
        Schema::dropIfExists('service_order_reviews');
    }
}
