<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'role_id' => \App\Role::all()->random()->id,
            'type' => $this->faker->randomElement(['admin', 'staff']),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'cost' => $this->faker->randomFloat(2, 0, 100),
            'is_active' => $this->faker->boolean,
            'password' => Hash::make(Str::random(10)),
            'remember_token' => Str::random(10),
        ];
    }
}
