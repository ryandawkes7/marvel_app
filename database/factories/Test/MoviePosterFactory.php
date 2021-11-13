<?php

namespace Database\Factories\Test;

use App\Models\MoviePoster;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoviePosterFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MoviePoster::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_url' => "https://oyster.ignimgs.com/wordpress/stg.ign.com/2021/04/Shang-Chi-Poster-Marvel.jpeg"
        ];
    }
}
