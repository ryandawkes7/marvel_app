<?php

namespace Tests;

use App\Models\Director;
use App\Models\Movie;
use App\Models\MovieDirector;
use App\Models\MovieMovieSaga;
use App\Models\MovieSaga;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends MarvelTest
{
    use RefreshDatabase;

    public $api_key;
    public $shop_url;
    public $headers;
    public $trade_in;
    public $path_prefix;
    public $movie;

    protected function setUp(): void
    {
        parent::setUp();

        // Generate API token
        $token = $this->user->createToken('Test Token', ['create', 'read']);
        $this->api_key = explode('|', $token->plainTextToken, 2)[1];


        $this->headers = [
            'Accept'                    => 'application/json'
        ];

        $this->path_prefix = "/api";
    }

    /**
     * Creates an MCU movie instance 
     *
     * @return \App\Models\Movie
     */
    protected function createMcuMovie()
    {
        return $this->movie = Movie::create([
            "title"         => "New Movie",
            "release_date"  => Carbon::parse("2021-10-29"),
            "in_mcu"        => 1,
            "mcu_phase_id"  => 1
        ]);
    }
    
    /**
     * Creates a non-MCU movie instance 
     *
     * @return \App\Models\Movie
     */
    protected function createNonMcuMovie()
    {
        return $this->movie = Movie::create([
            "title"         => "New Movie",
            "release_date"  => Carbon::parse("2021-10-29"),
            "in_mcu"        => 0,
            "mcu_phase_id"  => null
        ]);
    }

    public function createMovieWithSaga($saga_id)
    {
        return $this->movie = Movie::create([
            "title"         => "New Movie",
            "release_date"  => Carbon::parse("2021-10-29"),
            "in_mcu"        => 0,
            "mcu_phase_id"  => null,
            "sagas"         => [
                "id" => $saga_id
            ]
        ]);
    }

    /**
     * Deletes all movies from DB
     *
     * @return void
     */
    protected function flushMovies()
    {
        foreach (Movie::all() as $movie) {
            $movie->delete();
        }
    }
    
    /**
     * Deletes all saga and movie-saga relationships from DB
     *
     * @return void
     */
    protected function flushSagas()
    {
        foreach (MovieSaga::all() as $saga) {
            $saga->delete();
        }
        
        foreach (MovieMovieSaga::all() as $saga) {
            $saga->delete();
        }
    }
    
    /**
     * Deletes all director and movie-director relationships from DB
     *
     * @return void
     */
    protected function flushDirectors()
    {
        foreach (Director::all() as $director) {
            $director->delete();
        }
        
        foreach (MovieDirector::all() as $director) {
            $director->delete();
        }
    }
}
