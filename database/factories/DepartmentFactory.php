<?php

namespace Database\Factories;

use App\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Customer Service', 'Technology', 'Management']),
            'handle' => $this->faker->randomElement(['customer-service', 'technology', 'management']),
        ];
    }
}
