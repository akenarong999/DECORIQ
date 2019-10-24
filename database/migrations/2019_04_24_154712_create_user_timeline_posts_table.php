<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTimelinePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_timeline_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_user_id')->unsigned()->nullable(); // where post available.
            $table->integer('poster_user_id')->unsigned()->nullable(); // who post this post.
            $table->string('message');
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
        Schema::dropIfExists('user_timeline_posts');
    }
}
