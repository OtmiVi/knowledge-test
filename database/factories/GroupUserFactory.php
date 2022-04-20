<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GroupUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'group_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->unique()->numberBetween(2, 101),
        ];
    }
}
