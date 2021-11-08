<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\Test\CharacterTypeSeeder;
use Database\Seeders\Test\MovieSeeder;
use Database\Seeders\Test\DirectorSeeder;
use Database\Seeders\Test\MovieSagaSeeder;
use Database\Seeders\Test\TraitSeeder;
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
            MovieSeeder::class,
            MovieSagaSeeder::class,
            DirectorSeeder::class,
            CharacterTypeSeeder::class,
            TraitSeeder::class
        ]);

        $this->user = User::factory()->create();

    }
}