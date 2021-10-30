<?php

namespace Database\Seeders\Test;

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
        DB::table('movie_sagas')->insert([
            [
                'title' => 'Test Saga',
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ]
        ]);
    }
}
