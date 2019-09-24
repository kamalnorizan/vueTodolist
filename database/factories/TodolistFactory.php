<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Todolist;
use Faker\Generator as Faker;

$factory->define(Todolist::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->sentence(6),
        'Description'   => $faker->text(300),
        'user_id'   => rand(1,51),
    ];
});
