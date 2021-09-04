<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieDirectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movie_director')->insert([
            [
                'movie_id'      => 1,
                'director_id'   => 2
            ],
            [
                'movie_id'      => 2,
                'director_id'   => 3
            ],
            [
                'movie_id'      => 3,
                'director_id'   => 2
            ],
            [
                'movie_id'      => 4,
                'director_id'   => 4
            ],
            [
                'movie_id'      => 5,
                'director_id'   => 5
            ],
            [
                'movie_id'      => 6,
                'director_id'   => 6
            ],
            [
                'movie_id'      => 7,
                'director_id'   => 7
            ],
            [
                'movie_id'      => 8,
                'director_id'   => 8
            ],
            [
                'movie_id'      => 9,
                'director_id'   => 5
            ],
            [
                'movie_id'      => 10,
                'director_id'   => 1
            ],
            [
                'movie_id'      => 11,
                'director_id'   => 6
            ],
            [
                'movie_id'      => 12,
                'director_id'   => 11
            ],
            [
                'movie_id'      => 13,
                'director_id'   => 9
            ],
            [
                'movie_id'      => 13,
                'director_id'   => 10
            ],
            [
                'movie_id'      => 14,
                'director_id'   => 12
            ],
            [
                'movie_id'      => 15,
                'director_id'   => 1
            ],
            [
                'movie_id'      => 16,
                'director_id'   => 13
            ],
            [
                'movie_id'      => 17,
                'director_id'   => 14
            ],
            [
                'movie_id'      => 18,
                'director_id'   => 15
            ],
            [
                'movie_id'      => 19,
                'director_id'   => 9
            ],
            [
                'movie_id'      => 19,
                'director_id'   => 10
            ],
            [
                'movie_id'      => 20,
                'director_id'   => 11
            ],
            [
                'movie_id'      => 21,
                'director_id'   => 16
            ],
            [
                'movie_id'      => 21,
                'director_id'   => 17
            ],
            [
                'movie_id'      => 22,
                'director_id'   => 10
            ],
            [
                'movie_id'      => 22,
                'director_id'   => 11
            ],
            [
                'movie_id'      => 23,
                'director_id'   => 13
            ],
            [
                'movie_id'      => 24,
                'director_id'   => 18
            ],
            [
                'movie_id'      => 25,
                'director_id'   => 19
            ],
            [
                'movie_id'      => 26,
                'director_id'   => 20
            ],
            [
                'movie_id'      => 27,
                'director_id'   => 13
            ],
            [
                'movie_id'      => 28,
                'director_id'   => 21
            ],
            [
                'movie_id'      => 29,
                'director_id'   => 14
            ],
            [
                'movie_id'      => 30,
                'director_id'   => 15
            ],
            [
                'movie_id'      => 31,
                'director_id'   => 22
            ],
            [
                'movie_id'      => 32,
                'director_id'   => 11
            ]
        ]);
    }
}
