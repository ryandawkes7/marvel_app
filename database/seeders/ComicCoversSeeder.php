<?php

namespace Database\Seeders;

use App\Models\Comic;
use App\Models\ComicCover;
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
        ComicCover::truncate();
        Comic::find(1)->covers()->create([
            'cover_url' => "https://upload.wikimedia.org/wikipedia/en/5/54/AmazingSpider-Man1.jpg",
            'is_variant' => 0,
            'variant_issue' => null
        ]);
        
        Comic::find(2)->covers()->create([
            'cover_url' => "https://www.coverbrowser.com/image/fantastic-four/1-1.jpg",
            'is_variant' => 0,
            'variant_issue' => null
        ]);
        
        Comic::find(3)->covers()->create([
            'cover_url' => "https://d29xot63vimef3.cloudfront.net/image/captain-america/1-2.jpg",
            'is_variant' => 0,
            'variant_issue' => null
        ]);

        Comic::find(4)->covers()->create([
            'cover_url' => "https://d29xot63vimef3.cloudfront.net/image/doctor-strange/1-20.jpg",
            'is_variant' => 0,
            'variant_issue' => null
        ]);

        Comic::find(5)->covers()->create([
            'cover_url' => "https://d29xot63vimef3.cloudfront.net/image/hulk/1-3.jpg",
            'is_variant' => 0,
            'variant_issue' => null
        ]);
    }
}
