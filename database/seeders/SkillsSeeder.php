<?php

namespace Database\Seeders;

use App\Models\Skill;
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
        Skill::truncate();
        DB::table('skills')->insert([
            [
                'key'           => 'durability',
                'name'          => 'Durability',
                'colour'        => 'pink',
                'created_at'    => now()
            ],
            [
                'key'           => 'energy_projection',
                'name'          => 'Energy Projection',
                'colour'        => 'purple',
                'created_at'    => now()
            ],
            [
                'key'           => 'fighting_skills',
                'name'          => 'Fighting Skills',
                'colour'        => 'red',
                'created_at'    => now()
            ],
            [
                'key'           => 'intelligence',
                'name'          => 'Intelligence',
                'colour'        => 'blue',
                'created_at'    => now()
            ],
            [
                'key'           => 'speed',
                'name'          => 'Speed',
                'colour'        => 'yellow',
                'created_at'    => now()
            ],
            [
                'key'           => 'strength',
                'name'          => 'Strength',
                'colour'        => 'green',
                'created_at'    => now()
            ]
        ]);
    }
}
