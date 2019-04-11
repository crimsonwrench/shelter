<?php

use Faker\Generator as Faker;

$factory->define(App\Board::class, function (Faker $faker) {
    return [
        'name_short' => $faker->randomLetter,
        'name' => $faker->word
    ];
});
