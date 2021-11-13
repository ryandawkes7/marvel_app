<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->name,
            'release_date'  => Carbon::parse($this->faker->date()),
            'in_mcu'        => $this->faker->boolean(),
            'mcu_phase_id'  => $this->faker->numberBetween(1, 4)
        ];
    }
}
