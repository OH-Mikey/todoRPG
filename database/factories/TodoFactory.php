<?php

use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->lazy(),
        'name' => $faker->name,
        'category' => $faker->randomElement(['gaming', 'working', 'thinking', 'eating', 'reading', 'drinking']),
        'status' => 1
    ];
});
