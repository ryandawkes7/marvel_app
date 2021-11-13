<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * 'alias'      => string,
     * 'real_name'  => string,
     * 'sex'        => enum,
     * 'thumb_url'  => string,
     * 'morality'   => enum,
     * 'type_id'    => integer,
     * 'created_at' => Date
     *
     * @return void
     */
    public function run()
    {
        Character::truncate();
        DB::table('characters')->insert([
            [
                'alias'      => 'Mr. Fantastic',
                'real_name'  => 'Reed Richards',
                'sex'        => 'male',
                'thumb_url'  => 'https://static.wikia.nocookie.net/marveldatabase/images/8/84/Reed_Richards_(Earth-616)_from_Fantastic_Four_Vol_6_25_cover_001.jpg',
                'morality'   => 'hero',
                'type_id'    => 1,
                'created_at' => now()
            ],
            [
                'alias'      => 'Dr. Doom',
                'real_name'  => 'Victor Von Doom',
                'sex'        => 'male',
                'thumb_url'  => 'https://static.wikia.nocookie.net/marveldatabase/images/e/e0/Amazing_Spider-Man_Vol_5_11_Fantastic_Four_Villains_Variant_Textless.jpg',
                'morality'   => 'evil',
                'type_id'    => 1,
                'created_at' => now()
            ],
            [
                'alias'      => 'Deadpool',
                'real_name'  => 'Wade Wilson',
                'sex'        => 'male',
                'thumb_url'  => 'https://static.wikia.nocookie.net/marveldatabase/images/e/e3/Despicable_Deadpool_Vol_1_300_Liefeld_Variant_Textless.jpg',
                'morality'   => 'anti-hero',
                'type_id'    => 1,
                'created_at' => now()
            ],
            [
                'alias'      => 'Ultron',
                'real_name'  => null,
                'sex'        => 'unknown',
                'thumb_url'  => 'https://static.wikia.nocookie.net/marveldatabase/images/4/4b/Tony_Stark_Iron_Man_Vol_1_16_Textless.jpg',
                'morality'   => 'evil',
                'type_id'    => 2,
                'created_at' => now()
            ],
            [
                'alias'      => 'Storm',
                'real_name'  => 'Ororo Munroe',
                'sex'        => 'female',
                'thumb_url'  => 'https://static.wikia.nocookie.net/marveldatabase/images/7/7f/Marvel_Comics_Vol_1_1000_Bartel_Variant_Textless.jpg',
                'morality'   => 'hero',
                'type_id'    => 1,
                'created_at' => now()
            ],
            [
                'alias'      => 'Venom',
                'real_name'  => null,
                'sex'        => 'none',
                'thumb_url'  => 'https://static.wikia.nocookie.net/marveldatabase/images/c/c4/Venom_Vol_4_34_Unknown_Comic_Books_Exclusive_Virgin_Variant.jpg',
                'morality'   => 'anti-villain',
                'type_id'    => 3,
                'created_at' => now()
            ],
            [
                'alias'      => 'MJ',
                'real_name'  => 'Mary Jane Watson',
                'sex'        => 'female',
                'thumb_url'  => 'https://static.wikia.nocookie.net/marveldatabase/images/5/5c/Amazing_Spider-Man_Vol_5_1_ComicBookRealm.com_Exclusive_Virgin_Variant.jpg',
                'morality'   => 'neutral',
                'type_id'    => 1,
                'created_at' => now()
            ],
            [
                'alias'      => 'Watcher',
                'real_name'  => 'Uatu',
                'sex'        => 'unknown',
                'thumb_url'  => 'https://static.wikia.nocookie.net/marveldatabase/images/d/d3/Uatu_%28Earth-616%29_from_Marvel_War_of_Heroes_001.png',
                'morality'   => 'unknown',
                'type_id'    => 3,
                'created_at' => now()
            ],
            [
                'alias'      => 'Spider-Man',
                'real_name'  => 'Peter Parker',
                'sex'        => 'male',
                'thumb_url'  => 'https://upload.wikimedia.org/wikipedia/en/2/21/Web_of_Spider-Man_Vol_1_129-1.png',
                'morality'   => 'hero',
                'type_id'    => 1,
                'created_at' => now()
            ],
            [
                'alias'      => 'Hulk',
                'real_name'  => 'Bruce Banner',
                'sex'        => 'male',
                'thumb_url'  => 'https://upload.wikimedia.org/wikipedia/en/a/aa/Hulk_%28circa_2019%29.png',
                'morality'   => 'hero',
                'type_id'    => 1,
                'created_at' => now()
            ],
            [
                'alias'      => 'Doctor Strange',
                'real_name'  => 'Stephen Strange',
                'sex'        => 'male',
                'thumb_url'  => 'https://upload.wikimedia.org/wikipedia/en/4/4f/Doctor_Strange_Vol_4_2_Ross_Variant_Textless.jpg',
                'morality'   => 'hero',
                'type_id'    => 1,
                'created_at' => now()
            ],
            [
                'alias'      => 'Captain America',
                'real_name'  => 'Steve Rogers',
                'sex'        => 'male',
                'thumb_url'  => 'https://upload.wikimedia.org/wikipedia/en/9/91/CaptainAmerica109.jpg',
                'morality'   => 'hero',
                'type_id'    => 1,
                'created_at' => now()
            ],
        ]);
    }
}
