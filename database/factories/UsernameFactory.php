<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Username;
use Faker\Generator as Faker;

$factory->define(Username::class, function (Faker $faker) {
    
    return [
        'name' => $faker->userName,
    ];
});
