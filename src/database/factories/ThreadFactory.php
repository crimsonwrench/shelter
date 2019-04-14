<?php

use App\Board;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Thread::class, function (Faker $faker) {

    $board = Board::inRandomOrder()->first();
    $user = User::inRandomOrder()->first();
    return [
        'link_id' => Str::random(10),
        'board_id' => $board->id,
        'user_id' => $user->id,
        'title' => $faker->realText(rand(10, 100)),
        'text' => $faker->realText(rand(20, 100)),

    ];
});
