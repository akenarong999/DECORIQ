<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('shippings', function($table) {
        $table->string('description')->nullable;
        $table->string('private_description')->nullable;

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('shippings', function($table) {
        $table->dropColumn('description');
        $table->dropColumn('private_description');

      });
    }
}
