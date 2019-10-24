<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('category_id');
            $table->string('sku')->nullable();
            $table->string('product_type');
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('weight')->nullable();
            $table->string('stock')->nullable();
            $table->integer('is_publish')->unsigned();
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
        Schema::dropIfExists('products');
    }
}
