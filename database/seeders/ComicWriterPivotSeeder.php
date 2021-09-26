<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicWriterPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // comic_writer_pivot seeder
        DB::table('comic_writer_pivot')->truncate();
        DB::table('comic_writer_pivot')->insert([
            [
                'comic_book_id' => 1,
                'comic_writer_id' => 1
            ],
            [
                'comic_book_id' => 2,
                'comic_writer_id' => 1
            ],
            [
                'comic_book_id' => 4,
                'comic_writer_id' => 2
            ],
        ]);
    }
}
