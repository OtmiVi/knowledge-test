<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherDescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $positions = [
            'доцент',
            'асистент',
            'зав. кафедрою',
            'професор'
        ];
        return [
            'user_id' => $this->faker->unique()->numberBetween(102, 121),
            'description' => $this->faker->text(),
            'position' => $this->faker->randomElement($positions),
        ];
    }
}
