<?php

namespace Database\Seeders;

use App\Models\MovieSaga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MovieSagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovieSaga::truncate();
        DB::table('movie_sagas')->insert([
            [
                'title' => 'Spider-Man (Raimi)',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Spider-Man (Webb)',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Spider-Man (MCU)',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Thor',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Captain America',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Iron Man',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Guardians of the Galaxy',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'The Avengers',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Ant-Man',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Black Panther',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Blade',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Fantastic Four (Story)',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Ghost Rider',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'X-Men',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Deadpool',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Captain Marvel',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Venom',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Into the Spider-Verse',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],
            [
                'title' => 'Men In Black',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ],

        ]);
    }
}
