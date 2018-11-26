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
            $table->unsignedInteger('board_id')->nullable()
                ->foreign('board_id')
                ->references('id')
                ->on('boards');
            $table->integer('num');
            $table->unsignedInteger('user_id')->nullable()
                ->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->boolean('is_op')->default('0');
            $table->integer('belongs_to')->nullable();
            $table->string('title', 50)->nullable();
            $table->text('text');
            $table->timestamps();
            $table->boolean('is_sage')->default('0');
            $table->boolean('is_sticky')->default('0');
            $table->enum('status', ['active', 'closed', 'sinking', 'deleted', 'banned'])->default('active');
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
