<?php

namespace Database\Seeders\Test;

use App\Models\MoviePoster;
use Illuminate\Database\Seeder;

class MoviePosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MoviePoster::factory()->count(1)->create();
    }
}
