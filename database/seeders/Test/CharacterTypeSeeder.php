<?php

namespace Database\Seeders\Test;

use App\Models\CharacterType;
use Illuminate\Database\Seeder;

class CharacterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CharacterType::factory()->count(3)->create();
    }
}
