<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // comics seeder
        DB::table('comics')->truncate();
        DB::table('comics')->insert([
            [
                'comic_book_id' => 1,
                'title'         => null,
                'description'   => null,
                'issue_number'  => 1,
                'volume_number' => 1
            ],
            [
                'comic_book_id' => 2,
                'title'         => null,
                'description'   => null,
                'issue_number'  => 1,
                'volume_number' => 1
            ],
            [
                'comic_book_id' => 3,
                'title'         => null,
                'description'   => null,
                'issue_number'  => 1,
                'volume_number' => 1
            ],
            [
                'comic_book_id' => 4,
                'title'         => null,
                'description'   => null,
                'issue_number'  => 1,
                'volume_number' => 1
            ],
            [
                'comic_book_id' => 5,
                'title'         => null,
                'description'   => null,
                'issue_number'  => 1,
                'volume_number' => 1
            ],
        ]);
    }
}
