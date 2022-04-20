<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DisciplineUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'discipline_id' => $this->faker->numberBetween(1, 25),
            'user_id' => $this->faker->numberBetween(102, 121),
        ];
    }
}
