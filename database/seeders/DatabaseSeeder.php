<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call([
            ActorSeeder::class,
            CharacterGroupSeeder::class,
            ComicGroupSeeder::class,
            McuPhaseSeeder::class,
            MovieDirectorsSeeder::class,
            MoviePosterSeeder::class,
            MovieSagaSeeder::class,
            MovieSagaMoviePivotSeeder::class,
            MoviesSeeder::class,
            SkillsSeeder::class,
            TraitSeeder::class,
            TvShowSeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
