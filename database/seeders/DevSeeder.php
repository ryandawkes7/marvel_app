<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CharacterSeeder::class);
        $this->call(CharacterTypesSeeder::class);
        $this->call(DirectorsSeeder::class);
        $this->call(McuPhaseSeeder::class);
        $this->call(MovieDirectorsSeeder::class);
        $this->call(MovieSagaMoviePivotSeeder::class);
        $this->call(MovieSagaSeeder::class);
        $this->call(MoviesSeeder::class);
        $this->call(SkillsSeeder::class);
        $this->call(TraitSeeder::class);
    }
}
