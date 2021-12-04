<?php

namespace Database\Seeders;

use App\Models\Comic;
use App\Models\ComicBook;
use Illuminate\Database\Seeder;

class ComicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // comics seeder
        Comic::truncate();
        ComicBook::find(1)->comicIssues()->create([
            'title'         => null,
            'description'   => null,
            'issue_number'  => 1,
            'volume_number' => 1
        ]);
        
        ComicBook::find(2)->comicIssues()->create([
            'title'         => null,
            'description'   => null,
            'issue_number'  => 1,
            'volume_number' => 1
        ]);
        
        ComicBook::find(3)->comicIssues()->create([
            'title'         => null,
            'description'   => null,
            'issue_number'  => 1,
            'volume_number' => 1
        ]);

        ComicBook::find(4)->comicIssues()->create([
            'title'         => null,
            'description'   => null,
            'issue_number'  => 1,
            'volume_number' => 1
        ]);

        ComicBook::find(5)->comicIssues()->create([
            'title'         => null,
            'description'   => null,
            'issue_number'  => 1,
            'volume_number' => 1
        ]);
    }
}
