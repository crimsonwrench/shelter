<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('thread_id')
                ->foreign('thread_id')
                ->references('id')
                ->on('threads');
            $table->unsignedInteger('parent_post_id')->nullable();           
            $table->unsignedInteger('user_id')
                ->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->text('text');
            $table->integer('rating')->default('0');
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
        Schema::dropIfExists('posts');
    }
}
