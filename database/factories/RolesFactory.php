<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    
    return [
        'department_id' => factory(App\Department::class)->create()->id,
        'name' => $faker->randomElement(['User', 'Staff', 'Admin']),
        'handle' => $faker->randomElement(['user', 'staff', 'admin']),
    ];
});
