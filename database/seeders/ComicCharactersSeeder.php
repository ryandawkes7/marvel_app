<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicCharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // character_comic seeder
        DB::table('character_comic')->truncate();
        DB::table('character_comic')->insert([
            [
                'character_id'  => 1,
                'comic_id'      => 2
            ],
            [
                'character_id'  => 9,
                'comic_id'      => 1
            ],
            [
                'character_id'  => 10,
                'comic_id'      => 5
            ],
            [
                'character_id'  => 11,
                'comic_id'      => 4
            ],
            [
                'character_id'  => 12,
                'comic_id'      => 3
            ],
        ]);
    }
}
