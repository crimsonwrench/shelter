<?php

use App\Board;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {

    $board = Board::where('id', 1)->first();
    $board->last_post_num++;
    $board->save();

    return [
        'board_id' => 1,
        'title' => $faker->realText(50),
        'text' => $faker->realText(rand(10, 90)),
        'num' => $board->last_post_num,
        'is_op' => 1,
        'poster_ip' => '127.0.0.1',
    ];
});

$factory->state(App\Post::class, 'posts', function (Faker $faker) {

    $board = Board::where('id', 1)->first();

    $thread = $board->threads()->inRandomOrder()->first();

    return [
        'board_id' => 1,
        'belongs_to' => $thread->id,
        'text' => $faker->realText(rand(10, 50)),
        'num' => $board->last_post_num,
        'poster_ip' => '127.0.0.1',
        'is_op' => 0,
    ];
});
