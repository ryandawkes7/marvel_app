<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call(ComicBooksSeeder::class);
        $this->call(ComicCoversSeeder::class);
        $this->call(ComicsSeeder::class);
        $this->call(ComicWritersSeeder::class);
        $this->call(ComicWriterPivotSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
