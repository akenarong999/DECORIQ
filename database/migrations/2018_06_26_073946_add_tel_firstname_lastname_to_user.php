<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTelFirstnameLastnameToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
          $table->string('telnumber');
          $table->string('firstname');
          $table->string('lastname');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('roles', function (Blueprint $table) {
      $table->dropColumn('telnumber');
      $table->dropColumn('firstname');
      $table->dropColumn('lastname');
      });
    }
}
