<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => 'Question: "'.$this->faker->text(20). '"',
            'test_id' => $this->faker->numberBetween(1, 150),
        ];
    }
}
