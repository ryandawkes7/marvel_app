<?php

namespace Database\Seeders\Test;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            [
                'title'         => 'Test Non-MCU Movie',
                'release_date'  => Carbon::parse('1997-09-06'),
                'in_mcu'        => 0,
                'mcu_phase_id'  => null,
            ],
            [
                'title'         => 'Test MCU Movie',
                'release_date'  => Carbon::parse('1970-11-09'),
                'in_mcu'        => 1,
                'mcu_phase_id'  => 2
            ],
        ]);
    }
}
