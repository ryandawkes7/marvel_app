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
        $this->call(ComicBooksSeeder::class);
        $this->call(ComicsSeeder::class);
        $this->call(ComicCoversSeeder::class);
        $this->call(ComicWritersSeeder::class);
        $this->call(ComicWriterPivotSeeder::class);
    }
}
