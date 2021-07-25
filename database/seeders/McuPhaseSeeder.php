<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class McuPhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mcu_phases')->insert([
            [
                'title'         => 'Phase 1',
                'created_at'    => Date::now(),
                'updated_at'    => Date::now()
            ],
            [
                'title' => 'Phase 2',
                'created_at'    => Date::now(),
                'updated_at'    => Date::now()
            ],
            [
                'title' => 'Phase 3',
                'created_at'    => Date::now(),
                'updated_at'    => Date::now()
            ],
            [
                'title' => 'Phase 4',
                'created_at'    => Date::now(),
                'updated_at'    => Date::now()
            ],
        ]);
    }
}
