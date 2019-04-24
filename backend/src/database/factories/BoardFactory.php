<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Board::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(),
        'name' => str_replace('.', '', Str::studly($faker->text($faker->numberBetween(10, 30)))),
    ];
});
