<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Seed comic books
        DB::table('comic_books')->truncate();
        DB::table('comic_books')->insert([
            [
                'title' => 'The Amazing Spider-Man',
                'description' => '',
                'release_date' => Carbon::parse('1964-10-01')
            ],
            [
                'title' => 'Fantastic Four',
                'description' => '',
                'release_date' => Carbon::parse('1961-11-01')
            ],
            [
                'title' => 'Captain America',
                'description' => '',
                'release_date' => Carbon::parse('1941-03-01')
            ],
            [
                'title' => 'Doctor Strange',
                'description' => '',
                'release_date' => Carbon::parse('1968-06-01')
            ],
            [
                'title' => 'The Incredible Hulk',
                'description' => '',
                'release_date' => Carbon::parse('1962-05-01')
            ],
        ]);

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

        // Pivot
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
