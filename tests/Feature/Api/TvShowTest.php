<?php

namespace Tests\Feature\Api;

use Tests\ApiTest;

class TvShowTest extends ApiTest
{
    public function test_fetching_all_tv_shows_successfully()
    {
        $response = $this->getJson("{$this->path_prefix}/tv-shows");
        $response->assertOk();
        $response->assertJsonCount(3, 'data');
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_all_tv_shows_where_none_exist()
    {
        $this->flushTvShows();
        $response = $this->getJson("{$this->path_prefix}/tv-shows");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => [],
            'message'   => "No TV Shows found in the database"
        ]);
    }

    public function test_fetching_specific_tv_show_successfully()
    {
        $this->createTvShow();
        $response = $this->getJson("{$this->path_prefix}/tv-shows/{$this->tv_show->id}");
        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'title'         => $this->tv_show->title,
                'episode_count' => $this->tv_show->episode_count,
                'season_count'  => $this->tv_show->season_count,
                'logo_url'      => $this->tv_show->logo_url,
                'description'   => $this->tv_show->description,
                'in_mcu'        => $this->tv_show->in_mcu,
                'mcu_phase_id'  => $this->tv_show->mcu_phase_id,
                'release_date'  => $this->tv_show->release_date,
            ],
            'message'   => "Successfully found TV Show"
        ]);
    }

    public function test_fetching_specific_tv_show_that_does_not_exist()
    {
        $this->flushTvShows();
        $param = 1337;
        $response = $this->getJson("{$this->path_prefix}/tv-shows/{$param}");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find TV Show matching ID {$param}"
        ]);
    }

    public function test_creating_a_tv_show_successfully()
    {
        $this->flushTvShows();
        $tv_show_data = [
            'title'         => "Created Show",
            'episode_count' => 5,
            'season_count'  => 1,
            'logo_url'      => "https://static.wikia.nocookie.net/logopedia/images/c/cd/Marvel_Entertainment_Logo_%282012%29.jpg",
            'description'   => null,
            'in_mcu'        => 1,
            'mcu_phase_id'  => 2,
            'release_date'  => date('Y-m-d', strtotime("1997-09-06")),
        ];
        $response = $this->postJson(
            "{$this->path_prefix}/tv-shows",
            $tv_show_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'title'         => $tv_show_data['title'],
                'episode_count' => $tv_show_data['episode_count'],
                'season_count'  => $tv_show_data['season_count'],
                'logo_url'      => $tv_show_data['logo_url'],
                'description'   => $tv_show_data['description'],
                'in_mcu'        => $tv_show_data['in_mcu'],
                'mcu_phase_id'  => $tv_show_data['mcu_phase_id'],
                'release_date'  => $tv_show_data['release_date'],
            ],
            'message'   => "Successfully created new TV Show"
        ]);
        $this->assertDatabaseCount('tv_shows', 1);
        $this->assertDatabaseHas('tv_shows', [
            'title'         => $tv_show_data['title'],
            'episode_count' => $tv_show_data['episode_count'],
            'season_count'  => $tv_show_data['season_count'],
            'logo_url'      => $tv_show_data['logo_url'],
            'description'   => $tv_show_data['description'],
            'in_mcu'        => $tv_show_data['in_mcu'],
            'mcu_phase_id'  => $tv_show_data['mcu_phase_id'],
            'release_date'  => $tv_show_data['release_date'],
        ]);   
    }
    
    public function test_creating_a_tv_show_with_invalid_data()
    {
        $this->flushTvShows();
        $tv_show_data = [
            'title'         => 123,
            'episode_count' => 456,
            'season_count'  => 789,
            'logo_url'      => 123,
            'description'   => 456,
            'in_mcu'        => 789,
            'mcu_phase_id'  => 123,
            'release_date'  => 456,
        ];
        $response = $this->postJson(
            "{$this->path_prefix}/tv-shows",
            $tv_show_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('tv_shows', 0);
        $this->assertDatabaseMissing('tv_shows', [
            'title'         => $tv_show_data['title'],
            'episode_count' => $tv_show_data['episode_count'],
            'season_count'  => $tv_show_data['season_count'],
            'logo_url'      => $tv_show_data['logo_url'],
            'description'   => $tv_show_data['description'],
            'in_mcu'        => $tv_show_data['in_mcu'],
            'mcu_phase_id'  => $tv_show_data['mcu_phase_id'],
            'release_date'  => $tv_show_data['release_date'],
        ]);
    }
    
    public function test_updating_a_tv_show_successfully()
    {
        $this->flushTvShows();
        $this->createTvShow();
        $tv_show_data = [
            'title'         => "Updated Show",
            'episode_count' => 5,
            'season_count'  => 1,
            'logo_url'      => "https://static.wikia.nocookie.net/logopedia/images/c/cd/Marvel_Entertainment_Logo_%282012%29.jpg",
            'description'   => null,
            'in_mcu'        => 1,
            'mcu_phase_id'  => 2,
            'release_date'  => date('Y-m-d', strtotime("1997-09-06")),
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/tv-shows/{$this->tv_show->id}",
            $tv_show_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'title'         => $tv_show_data['title'],
                'episode_count' => $tv_show_data['episode_count'],
                'season_count'  => $tv_show_data['season_count'],
                'logo_url'      => $tv_show_data['logo_url'],
                'description'   => $tv_show_data['description'],
                'in_mcu'        => $tv_show_data['in_mcu'],
                'mcu_phase_id'  => $tv_show_data['mcu_phase_id'],
                'release_date'  => $tv_show_data['release_date'],
            ],
            'message'   => "Successfully updated TV Show"
        ]);
        $this->assertDatabaseHas('tv_shows', [
            'title'         => $tv_show_data['title'],
            'episode_count' => $tv_show_data['episode_count'],
            'season_count'  => $tv_show_data['season_count'],
            'logo_url'      => $tv_show_data['logo_url'],
            'description'   => $tv_show_data['description'],
            'in_mcu'        => $tv_show_data['in_mcu'],
            'mcu_phase_id'  => $tv_show_data['mcu_phase_id'],
            'release_date'  => $tv_show_data['release_date'],
        ]);
    }

    public function test_updating_a_tv_show_with_invalid_data()
    {
        $this->flushTvShows();
        $this->createTvShow();
        $tv_show_data = [
            'title'         => 123,
            'episode_count' => 456,
            'season_count'  => 789,
            'logo_url'      => 123,
            'description'   => 456,
            'in_mcu'        => 789,
            'mcu_phase_id'  => 123,
            'release_date'  => 456,
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/tv-shows/{$this->tv_show->id}",
            $tv_show_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data','message']);
        $this->assertDatabaseMissing('tv_shows', [
            'title'         => $tv_show_data['title'],
            'episode_count' => $tv_show_data['episode_count'],
            'season_count'  => $tv_show_data['season_count'],
            'logo_url'      => $tv_show_data['logo_url'],
            'description'   => $tv_show_data['description'],
            'in_mcu'        => $tv_show_data['in_mcu'],
            'mcu_phase_id'  => $tv_show_data['mcu_phase_id'],
            'release_date'  => $tv_show_data['release_date'],
        ]);
    }

    public function test_updating_a_tv_show_with_that_does_not_exist()
    {
        $this->flushTvShows();
        $param = 1337;
        $tv_show_data = [
            'title'         => "Updated Show",
            'episode_count' => 5,
            'season_count'  => 1,
            'logo_url'      => "https://static.wikia.nocookie.net/logopedia/images/c/cd/Marvel_Entertainment_Logo_%282012%29.jpg",
            'description'   => null,
            'in_mcu'        => 1,
            'mcu_phase_id'  => 2,
            'release_date'  => date('Y-m-d', strtotime("1997-09-06")),
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/tv-shows/{$param}",
            $tv_show_data,
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find TV Show matching ID {$param}"
        ]);
        $this->assertDatabaseMissing('tv_shows', [
            'title'         => $tv_show_data['title'],
            'episode_count' => $tv_show_data['episode_count'],
            'season_count'  => $tv_show_data['season_count'],
            'logo_url'      => $tv_show_data['logo_url'],
            'description'   => $tv_show_data['description'],
            'in_mcu'        => $tv_show_data['in_mcu'],
            'mcu_phase_id'  => $tv_show_data['mcu_phase_id'],
            'release_date'  => $tv_show_data['release_date'],
        ]);
    }

    public function test_deleting_a_tv_show_successfully()
    {
        $this->flushTvShows();
        $this->createTvShow();
        $tv_show_id = $this->tv_show->id;
        $response = $this->deleteJson(
            "{$this->path_prefix}/tv-shows/{$this->tv_show->id}",
            [],
            $this->headers
        );
        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => "Successfully deleted TV Show matching ID {$tv_show_id}"
        ]);
        $this->assertDatabaseCount('tv_shows', 0);
    }

    public function test_deleting_a_tv_show_with_that_does_not_exist()
    {
        $this->flushTvShows();
        $this->createTvShow();
        $param = 1337;
        $response = $this->deleteJson(
            "{$this->path_prefix}/tv-shows/{$param}",
            [],
            $this->headers
        );
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No TV Show found matching ID {$param}"
        ]);
        $this->assertDatabaseCount('tv_shows', 1);
    }
}
