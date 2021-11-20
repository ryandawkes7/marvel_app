<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\ActorSeeder;
use Database\Seeders\ComicBooksSeeder;
use Database\Seeders\ComicWritersSeeder;
use Database\Seeders\McuPhaseSeeder;
use Database\Seeders\Test\CharacterTypeSeeder;
use Database\Seeders\Test\MovieSeeder;
use Database\Seeders\Test\DirectorSeeder;
use Database\Seeders\Test\MovieSagaSeeder;
use Database\Seeders\Test\TraitSeeder;
use Database\Seeders\TvShowSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarvelTest extends TestCase {
    use RefreshDatabase;
    
    public $user;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            ActorSeeder::class,
            CharacterTypeSeeder::class,
            ComicBooksSeeder::class,
            ComicWritersSeeder::class,
            DirectorSeeder::class,
            McuPhaseSeeder::class,
            MovieSagaSeeder::class,
            MovieSeeder::class,
            TraitSeeder::class,
            TvShowSeeder::class
        ]);

        $this->user = User::factory()->create();

    }
}