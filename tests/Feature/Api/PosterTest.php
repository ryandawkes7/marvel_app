<?php

namespace Tests\Feature\Api;

use App\Models\MoviePoster;
use Illuminate\Support\Facades\DB;
use Tests\ApiTest;

class PosterTest extends ApiTest
{
    /**
     * Test fetching all posters
     *
     * @return void
     */
    public function test_fetching_all_posters()
    {
        $response = $this->getJson("{$this->path_prefix}/posters");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }

    /**
     * Test fetching all posters when none exists in DB
     *
     * @return void
     */
    public function test_fetching_all_posters_when_none_exist()
    {
        $this->flushPosters();
        $response = $this->getJson("{$this->path_prefix}/posters");

        $response->assertNotFound();
        $response->assertJson([
            'data' => null,
            'message' => "No movie posters could be found"
        ]);
        $this->assertDatabaseCount('movie_posters', 0);
    }

    /**
     * Tesat fetching a specific poster
     *
     * @return void
     */
    public function test_fetching_one_poster()
    {
        $this->createMovieWithPoster();

        $response = $this->getJson("{$this->path_prefix}/posters/{$this->poster->id}");

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $response->assertJson([
            'data' => [
                'id'        => $this->poster->id,
                'movie_id'  => $this->movie->id,
                'image_url' => $this->poster->image_url,
                'user_id'   => $this->poster->user_id
            ],
            'message' => "Successfully fetched movie poster"
        ]);
    }
    
    /**
     * Test fetching poster when ID does not match any stored instances
     *
     * @return void
     */
    public function test_fetching_one_poster_where_poster_cannot_be_found()
    {
        $this->flushPosters();

        $poster_id = 1337;
        $response = $this->getJson("{$this->path_prefix}/posters/{$poster_id}");

        $response->assertNotFound();
        $response->assertJson([
            'data' => null,
            'message' => "Failed to find movie poster matching ID {$poster_id}"
        ]);
    }

    /**
     * Test creating a poster successfully
     *
     * @return void
     */
    public function test_creating_a_poster()
    {
        // Will flush posters as well
        $this->flushMovies();
        $this->createMcuMovie();

        $image_url = "https://oyster.ignimgs.com/wordpress/stg.ign.com/2021/04/Shang-Chi-Poster-Marvel.jpg";
        $response = $this->postJson(
            "{$this->path_prefix}/posters",
            [
                'movie_id'  => $this->movie->id,
                'image_url' => $image_url
            ],
            $this->headers
        );

        $poster = MoviePoster::orderByDesc('id')->first();

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('movie_posters', 1);
        $this->assertDatabaseHas('movie_posters', [
            'movie_id' => $this->movie->id,
            'image_url' => $image_url
        ]);
    }

    /**
     * Test creating a poster where invalid data is supplied
     *
     * @return void
     */
    public function test_creating_a_poster_with_invalid_data()
    {
        $this->flushPosters();

        $response = $this->postJson(
            "{$this->path_prefix}/posters",
            [
                'image_url' => "https://oyster.ignimgs.com/wordpress/stg.ign.com/2021/04/Shang-Chi-Poster-Marvel.jpg"
            ],
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('movie_posters', 0);
    }

    /**
     * Test updating poster successfully
     *
     * @return void
     */
    public function test_updating_a_poster()
    {
        $this->flushPosters();
        $this->createMovieWithPoster();

        $image_url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Test-Logo.svg/1280px-Test-Logo.svg.png';
        $response = $this->putJson(
            "{$this->path_prefix}/posters/{$this->poster->id}",
            [
                'image_url' => $image_url
            ],
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('movie_posters', 1);
        $this->assertDatabaseHas('movie_posters', [
            'id'        => $this->poster->id,
            'movie_id'  => $this->movie->id,
            'image_url' => $image_url
        ]);
    }

    /**
     * Test updating poster when invalid data is supplied
     *
     * @return void
     */
    public function test_updating_a_poster_with_invalid_data()
    {
        $this->flushPosters();
        $this->createMovieWithPoster();

        $image_url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Test-Logo.svg/1280px-Test-Logo';
        $response = $this->putJson(
            "{$this->path_prefix}/posters/{$this->poster->id}",
            [
                'image_url' => $image_url
            ],
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseMissing('movie_posters', [
            'id' => $this->poster->id,
            'image_url' => $image_url
        ]);
    }

    /**
     * Test updating poster when it cannot be found via the specified ID
     *
     * @return void
     */
    public function test_updating_a_poster_when_poster_cannot_be_found()
    {
        $this->flushPosters();

        $poster_id = 1337;
        $image_url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Test-Logo.svg/1280px-Test-Logo.svg.png';
        $response = $this->putJson(
            "{$this->path_prefix}/posters/{$poster_id}",
            [
                'image_url' => $image_url
            ],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find movie poster matching ID {$poster_id}"
        ]);
        $this->assertDatabaseCount('movie_posters', 0);
        $this->assertDatabaseMissing('movie_posters', [
            'id'        => $poster_id,
            'image_url' => $image_url
        ]);
    }

}
