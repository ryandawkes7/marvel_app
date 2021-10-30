<?php

namespace Database\Seeders\Test;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directors')->insert([
            [
                'name'  => 'Testing Director',
                'dob'   => Carbon::parse('1966-08-05'),
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/James_Gunn_%2828557194032%29_%28cropped%29.jpg/1024px-James_Gunn_%2828557194032%29_%28cropped%29.jpg'
            ]
        ]);
    }
}
