<?php

namespace Database\Seeders\Test;

use App\Models\Movie;
use App\Models\MoviePoster;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory()
                ->create()
                ->each(function ($movie) {
                    $movie->posters()->saveMany(MoviePoster::factory()->count(1)->make());
                });
    }
}
