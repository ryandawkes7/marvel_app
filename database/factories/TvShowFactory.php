<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TvShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->propertyTitle,
            'episode_count' => $this->faker->numberBetween(1, 50),
            'season_count'  => $this->faker->numberBetween(1, 4),
            'logo_url'      => "https://static.wikia.nocookie.net/logopedia/images/c/cd/Marvel_Entertainment_Logo_%282012%29.jpg",
            'description'   => "",
            'in_mcu'        => 1,
            'mcu_phase_id'  => $this->faker->numberBetween(1, 4),
            'release_date'  => $this->faker->date('Y-m-d')
        ];
    }
}
