<?php

namespace Tests\Feature\Api;

use App\Models\Director;
use App\Models\Movie;
use App\Models\MovieSaga;
use Illuminate\Support\Facades\Date;
use Tests\ApiTest;

class MovieTest extends ApiTest
{

    /**
     * Fetches all movies in the movies table
     *
     * @return void
     */
    public function test_fetching_all_movies()
    {
        $response = $this->get("{$this->path_prefix}/movies");

        $response->assertOk();
        $response->assertJsonStructure([
            "data",
            "message"
        ]);

        $this->assertDatabaseCount('movies', 1);
    }

    /**
     * Test fetching all movies when the movies table has no records
     *
     * @return void
     */
    public function test_fetching_movies_when_movies_table_is_empty()
    {
        $this->flushMovies();
        $response = $this->getJson("{$this->path_prefix}/movies");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No movies found"
        ]);

        $this->assertDatabaseCount('movies', 0);
    }

    /**
     * Fetches one specific instances from the movies table
     *
     * @return void
     */
    public function test_fetching_specific_movie() 
    {
        $movie_id = Movie::firstOrFail()->id;
        $response = $this->getJson("{$this->path_prefix}/movies/{$movie_id}");

        $response->assertOk();
        $response->assertJsonStructure([
            "data" => [
                "id",
                "title",
                "release_date",
                "in_mcu",
                "mcu_phase_id",
                "created_at",
                "updated_at",
                "sagas",
                "posters",
                "phase",
                "directors"
            ],
            "message"
        ]);
    }

    /**
     * Tests retrieving a movie record from a non-matching ID
     *
     * @return void
     */
    public function test_fetching_movie_where_id_does_not_match_any_records()
    {
        $search_id = 1337;
        $response = $this->getJson("{$this->path_prefix}/movies/{$search_id}");

        $response->assertNotFound();
        $response->assertJson([
            'data' => null,
            'message' => "Could not find a movie matching ID {$search_id}"
        ]);
    }

    /**
     * Test creating a new movie instance
     *
     * @return void
     */
    public function test_creating_movie()
    {
        $this->flushMovies();
        $saga_id = MovieSaga::first()->id;
        $director_id = Director::first()->id;

        $movie_data = [
            'title'         => "New Movie",
            'release_date'  => date('Y-m-d H:i:s', strtotime("2021-10-29 00:00:01")),
            'in_mcu'        => 1,
            'mcu_phase_id'  => null,
            'sagas'         => [
                ['id' => $saga_id]
            ],
            'directors'     => [
                ['id' => $director_id]
            ],
            'posters'       => ["https://oyster.ignimgs.com/wordpress/stg.ign.com/2021/04/Shang-Chi-Poster-Marvel.jpeg"]
        ];

        $response = $this->postJson(
            "{$this->path_prefix}/movies", 
            $movie_data,
            $this->headers
        );

        $movie_id = Movie::orderByDesc('id')->first()->id;

        $response->assertOk();
        $this->assertDatabaseHas('movies', ['id' => $movie_id]);
        $this->assertDatabaseHas('movie_movie_saga', [
            'id'            => 1,
            'movie_id'      => $movie_id,
            'movie_saga_id' => $saga_id
        ]);
        $this->assertDatabaseHas('movie_director', [
            'id'            => 1,
            'movie_id'      => $movie_id,
            'director_id'   => $director_id
        ]);
        

        $this->assertDatabaseCount('movie_movie_saga', 1);
        $this->assertDatabaseCount('movie_director', 1);
        $this->assertDatabaseCount('movies', 1);
    }

    /**
     * Test creating a movie with invalid data
     *
     * @return void
     */
    public function test_creating_movie_with_invalid_data()
    {
        $this->flushMovies();
        $response = $this->postJson(
            "{$this->path_prefix}/movies",
            [
                'release_date'  => date('Y-m-d H:i:s', strtotime(Date::now())),
                'in_mcu'        => 1,
                'mcu_phase_id'  => 1
            ],
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJson([
            'data'      => null,
            'message'   => [
                'title' => ['The title field is required.']
            ]
        ]);
        $this->assertDatabaseCount('movies', 0);
    }

    /**
     * Test creatinga movie with non-matching sagas
     *
     * @return void
     */
    public function test_creating_a_movie_with_non_matching_sagas()
    {
        $this->flushSagas();
        $this->flushMovies();

        $saga_id = 1;
        $response = $this->postJson(
            "{$this->path_prefix}/movies", 
            [
                "title"         => "New Movie",
                "release_date"  => date('Y-m-d H:i:s', strtotime(Date::now())),
                "in_mcu"        => 0,
                "mcu_phase_id"  => null,
                "sagas"         => [
                    [
                        "id"    => 1,
                    ]
                ]
            ],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find saga matching ID {$saga_id}"
        ]);

        $this->assertDatabaseCount('movies', 1);
        $this->assertDatabaseCount('movie_sagas', 0);
        $this->assertDatabaseCount('movie_movie_saga', 0);
    }
    
    /**
     * Test creatinga movie with non-matching directors
     *
     * @return void
     */
    public function test_creating_a_movie_with_non_matching_directors()
    {
        $this->flushDirectors();
        $this->flushMovies();

        $saga_id = 1;
        $response = $this->postJson(
            "{$this->path_prefix}/movies", 
            [
                "title"         => "New Movie",
                "release_date"  => date('Y-m-d H:i:s', strtotime(Date::now())),
                "in_mcu"        => 0,
                "mcu_phase_id"  => null,
                "directors"     => [
                    [
                        "id"    => 1,
                    ]
                ]
            ],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find director matching ID {$saga_id}"
        ]);

        $this->assertDatabaseCount('movies', 1);
        $this->assertDatabaseCount('directors', 0);
        $this->assertDatabaseCount('movie_director', 0);
    }

    /**
     * Test updating an existing movie instance
     *
     * @return void
     */
    public function test_updating_a_movie_instance() {
        $this->flushMovies();
        $this->createMcuMovie();
        $movie_data = [
            'title'         => "Updated Test Movie",
            'release_date'  => date('Y-m-d H:i:s', strtotime(Date::now())),
            'in_mcu'        => 0,
            'mcu_phase_id'  => null
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/movies/{$this->movie->id}",
            $movie_data,
            $this->headers
        );
        $updated_movie = Movie::whereId($this->movie->id)->first();

        $response->assertOk();
        $this->assertDatabaseHas('movies', [
            "id"            => $updated_movie->id,
            "title"         => $updated_movie->title,
            "release_date"  => date("Y-m-d", strtotime($updated_movie->release_date)),
            "in_mcu"        => $updated_movie->in_mcu,
            "mcu_phase_id"  => $updated_movie->mcu_phase_id,
        ]);
        
        $response->assertJsonStructure([
            'data' => [
                "id",            
                "title",       
                "release_date",
                "in_mcu",      
                "mcu_phase_id",
                "created_at",  
                "updated_at",  
                "sagas",       
                "posters",     
                "phase",       
            ], 
            "message"
        ]);
    }

    /**
     * Tests updating a movie that does not exist/cannot be found
     *
     * @return void
     */
    public function test_updating_a_movie_that_does_not_exist()
    {
        $this->flushSagas();
        $this->flushMovies();

        $movie_id = 1337;
        $response = $this->putJson(
            "{$this->path_prefix}/movies/{$movie_id}",
            [
                "title"         => "Iron Man 2",
                "release_date"  => "1984-03-08",
                "in_mcu"        => "1",
                "mcu_phase_id"  => 1,
            ],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find movie matching ID {$movie_id}"
        ]);

        $this->assertDatabaseCount('movies', 0);
    }

    /**
     * Test updating a movie with invalid data
     *
     * @return void
     */
    public function test_updating_a_movie_with_invalid_data()
    {
        $this->flushMovies();
        $this->createMcuMovie();

        $response = $this->putJson(
            "{$this->path_prefix}/movies/{$this->movie->id}",
            [],
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseHas('movies', [
            'title'         => $this->movie->title,
            'release_date'  => date('Y-m-d H:i:s', strtotime($this->movie->release_date)),
            'in_mcu'        => $this->movie->in_mcu,
            'mcu_phase_id'  => $this->movie->mcu_phase_id
        ]);
        $this->assertDatabaseCount('movies', 1);
    }

    /**
     * Tests updating a movie with a non-matching saga
     *
     * @return void
     */
    public function test_updating_a_movie_with_non_matching_saga()
    {
        $this->flushSagas();
        $this->flushMovies();
        $this->createMcuMovie();

        $saga_id = 1337;
        $response = $this->putJson(
            "{$this->path_prefix}/movies/{$this->movie->id}",
            [
                "title"         => $this->movie->title,
                "release_date"  => date('Y-m-d H:i:s', strtotime($this->movie->release_date)),
                "in_mcu"        => $this->movie->in_mcu,
                "mcu_phase_id"  => $this->movie->mcu_phase_id,
                "sagas"     => [
                    ["id"    => $saga_id]
                ]
            ],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data' => null,
            'message' => "Could not find saga matching ID {$saga_id}"
        ]);
        $this->assertDatabaseCount('movies', 1);
        $this->assertDatabaseCount('movie_movie_saga', 0);
    }
    
    /**
     * Tests updating a movie with a non-matching director
     *
     * @return void
     */
    public function test_updating_a_movie_with_non_matching_director()
    {
        $this->flushDirectors();
        $this->flushMovies();
        $this->createMcuMovie();

        $director_id = 1337;
        $response = $this->putJson(
            "{$this->path_prefix}/movies/{$this->movie->id}",
            [
                "title"         => $this->movie->title,
                "release_date"  => date('Y-m-d H:i:s', strtotime($this->movie->release_date)),
                "in_mcu"        => $this->movie->in_mcu,
                "mcu_phase_id"  => $this->movie->mcu_phase_id,
                "directors"     => [
                    ["id"    => $director_id]
                ]
            ],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data' => null,
            'message' => "Could not find director matching ID {$director_id}"
        ]);
        $this->assertDatabaseCount('movies', 1);
        $this->assertDatabaseCount('movie_director', 0);
    }

    /**
     * Tests deleting a specific instance of a movie
     *
     * @return void
     */
    public function test_deleting_a_movie_instance()
    {
        $this->createMcuMovie();
        $movies_count = Movie::count();
        $response = $this->deleteJson(
            "{$this->path_prefix}/movies/{$this->movie->id}",
            [],
            $this->headers
        );

        $response->assertOk();
        $this->assertDatabaseCount('movies', ($movies_count - 1));
        $this->assertDatabaseMissing(
            'movies',
            ['id' => $this->movie->id]
        );
    }

    /**
     * Test deleting a movie with an ID that does not match a movie from the DB
     *
     * @return void
     */
    public function test_deleting_a_not_found_movie()
    {
        $search_id = 1337;
        $response = $this->deleteJson(
            "{$this->path_prefix}/movies/{$search_id}",
            [],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            "data"      => null,
            "message"   => "Could not find movie with ID {$search_id}"
        ]);
    }
}
