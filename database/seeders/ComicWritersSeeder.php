<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicWritersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed writers
        DB::table('comic_writers')->truncate();
        DB::table('comic_writers')->insert([
            [
                'name' => 'Stan Lee',
                'dob' => Carbon::parse(28/12/1922),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Stan_Lee_by_Gage_Skidmore_3.jpg'
            ],
            [
                'name' => 'Steve Ditko',
                'dob' => Carbon::parse(02/9/1927),
                'image' => 'https://upload.wikimedia.org/wikipedia/en/2/28/Steve_Ditko.jpg'
            ],
        ]);
    }
}
