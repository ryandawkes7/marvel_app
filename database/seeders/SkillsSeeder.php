<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            [
                'name' => 'Durability',
                'colour' => 'pink',
                'created_at' => now()
            ],
            [
                'name' => 'Energy Projection',
                'colour' => 'purple',
                'created_at' => now()
            ],
            [
                'name' => 'Fighting Skills',
                'colour' => 'red',
                'created_at' => now()
            ],
            [
                'name' => 'Intelligence',
                'colour' => 'blue',
                'created_at' => now()
            ],
            [
                'name' => 'Speed',
                'colour' => 'yellow',
                'created_at' => now()
            ],
            [
                'name' => 'Strength',
                'colour' => 'green',
                'created_at' => now()
            ]
        ]);
    }
}
