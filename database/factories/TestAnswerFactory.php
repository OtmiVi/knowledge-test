<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'answer' => 'Answer: "'.$this->faker->text(20). '"',
            'right' =>$this->faker->boolean(),
            'test_question_id' => $this->faker->numberBetween(1, 1500),
        ];
    }
}
