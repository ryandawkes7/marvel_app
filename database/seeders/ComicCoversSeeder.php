<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicCoversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // comic_covers seeder
        DB::table('comic_covers')->truncate();
        DB::table('comic_covers')->insert([
            [
                'comic_id' => 1,
                'cover_url' => "https://upload.wikimedia.org/wikipedia/en/5/54/AmazingSpider-Man1.jpg",
                'is_variant' => 0,
                'variant_issue' => null
            ],
            [
                'comic_id' => 2,
                'cover_url' => "https://www.coverbrowser.com/image/fantastic-four/1-1.jpg",
                'is_variant' => 0,
                'variant_issue' => null
            ],
            [
                'comic_id' => 3,
                'cover_url' => "https://d29xot63vimef3.cloudfront.net/image/captain-america/1-2.jpg",
                'is_variant' => 0,
                'variant_issue' => null
            ],
            [
                'comic_id' => 4,
                'cover_url' => "https://d29xot63vimef3.cloudfront.net/image/doctor-strange/1-20.jpg",
                'is_variant' => 0,
                'variant_issue' => null
            ],
            [
                'comic_id' => 5,
                'cover_url' => "https://d29xot63vimef3.cloudfront.net/image/hulk/1-3.jpg",
                'is_variant' => 0,
                'variant_issue' => null
            ],
        ]);
    }
}
