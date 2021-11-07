<?php

namespace Database\Factories\Test;

use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key'   => strtolower($this->faker->firstName()),
            'type'  => ucfirst($this->faker->firstName())
        ];
    }
}
