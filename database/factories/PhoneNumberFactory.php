<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TelephoneNumber;
use Faker\Generator as Faker;

$factory->define(TelephoneNumber::class, function (Faker $faker) {
    
    return [
        'name' => $faker->phoneNumber,
    ];
});
