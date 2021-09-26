<?php

namespace Database\Seeders;

use App\Models\ComicBook;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicBooksSeeder extends Seeder
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
    }
}
