<?php

namespace Database\Seeders;

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
                ->has(MoviePoster::factory()->count(1))
                ->create();
    }
}
