<?php

namespace Database\Seeders\Test;

use App\Models\CharTrait;
use Illuminate\Database\Seeder;

class TraitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CharTrait::factory()->count(3)->create();
    }
}
