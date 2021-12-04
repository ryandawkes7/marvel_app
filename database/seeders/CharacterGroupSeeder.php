<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeds all character-related tables
        $this->call(CharacterSeeder::class);
        $this->call(CharacterTypesSeeder::class);
        $this->call(ComicCharactersSeeder::class);
    }
}
