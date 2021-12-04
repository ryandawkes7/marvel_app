<?php

namespace Database\Seeders;

use App\Models\TvShow;
use Illuminate\Database\Seeder;

class TvShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TvShow::truncate();
        TvShow::factory()->count(3)->create();
    }
}
