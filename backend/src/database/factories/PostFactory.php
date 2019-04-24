<?php

use App\Thread;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Post::class, function (Faker $faker) {

    $thread = Thread::inRandomOrder()->first();
    $user = User::inRandomOrder()->first();

    return [
        'thread_id' => $thread->id,
        'link_id' => Str::random(10),
        'user_id' => $user->id,
        'text' => $faker->realText($faker->numberBetween(50, 400)),
    ];
});
