<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('board_id')
                ->foreign('board_id')
                ->references('id')
                ->on('boards');
            $table->unsignedInteger('user_id')
                ->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->string('title', 100);
            $table->text('text');
            $table->integer('rating')->default('0');
            $table->boolean('is_sticky')->default('0');
            $table->enum('status', ['active', 'closed', 'dumped', 'archived',])->default('active');
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
        Schema::dropIfExists('threads');
    }
}
