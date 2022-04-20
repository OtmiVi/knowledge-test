<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GroupFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    

    public function definition()
    {
        $names=[
            'КІ-20-1к',
            'ТА-19',
            'АСІ-21м',
            'ПІ-21',
            'ДН-20к',
            'ФН-20',
            'ПБК-21',
            'M-19',
            'ОЛ-20м',
            'АО-21',
        ];
        return [
            'name' => $this->faker->unique()->randomElement($names),
        ];
    }

}
