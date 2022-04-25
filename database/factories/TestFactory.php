<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Test: "'.$this->faker->text(20). '"',
            'description' => $this->faker->text(),
            'visible' => $this->faker->boolean(),
            'discipline_id' => $this->faker->numberBetween(1, 25),
        ];
    }
}
