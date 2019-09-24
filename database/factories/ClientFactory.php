<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        //
        'name'  => $faker->name,
        'phoneNumber'   => $faker->e164PhoneNumber,
        'address'   => $faker->address,
        'user_id'   => factory(App\User::class),
    ];
});
