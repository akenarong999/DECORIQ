<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned();
            $table->string('name');
            $table->float('start_price', 10, 2);
            $table->longText('description');
            $table->integer('service_category_id')->unsigned();
            $table->text('requirement');
            $table->string('work_duration');
            $table->string('revision_time');
            $table->string('after_service_support_duration')->nullable();
            $table->string('after_service_support_description')->nullable();
            $table->string('allowlocations');
            $table->string('notallowlocations');
            $table->integer('service_status_id')->unsigned();
            $table->integer('is_publish')->unsigned();
            $table->string('slug');
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
        Schema::dropIfExists('services');
    }
}
