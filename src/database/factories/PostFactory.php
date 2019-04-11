<?php

use App\Board;
use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {

    $board = Board::where('id', 1)->first();
    $board->last_post_num++;
    $board->save();

    return [
        'board_id' => 1,
        'title' => $faker->realText(50),
        'text' => $faker->realText(rand(100, 200)),
        'num' => $board->last_post_num,
        'is_op' => 1,
    ];
});

$factory->state(App\Post::class, 'posts', function (Faker $faker) {

    $board = Board::where('id', 1)->first();
    $board->last_post_num++;
    $board->save();

    $thread = Post::where(['is_op' => 1, 'board_id' => 1])->inRandomOrder()->first();

    return [
        'board_id' => 1,
        'belongs_to' => $thread->id,
        'text' => $faker->realText(rand(30, 80)),
        'num' => $board->last_post_num,
    ];
});
