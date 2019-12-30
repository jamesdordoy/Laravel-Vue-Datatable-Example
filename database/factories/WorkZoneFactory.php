<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WorkZone;
use Faker\Generator as Faker;

$factory->define(WorkZone::class, function (Faker $faker) {
    
    return [
        'name' => $faker->citySuffix,
    ];
});
