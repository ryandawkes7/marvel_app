<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add character types
        DB::table('character_types')->truncate();
        DB::table('character_types')->insert([
            [
                'key'   => 'human',
                'type'  => 'Human'
            ],
            [
                'key'   => 'robot',
                'type'  => 'Robot',
            ],
            [
                'key' => 'unknown',
                'type' => 'Unknown',
            ],
        ]);
    }
}
