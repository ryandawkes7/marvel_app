<?php

namespace Tests\Feature\Api;

use Tests\ApiTest;

class ActorTest extends ApiTest
{
    public function test_fetching_all_actors_successfully()
    {
        $response = $this->getJson("{$this->path_prefix}/actors");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $response->assertJsonCount(3, 'data');
    }

    public function test_fetching_all_actors_where_none_exist()
    {
        $this->flushActors();
        $response = $this->getJson("{$this->path_prefix}/actors");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No actors could be found in the database"
        ]);
    }
    
    public function test_fetching_a_specific_actor_successfully()
    {
        $this->createActor();
        $response = $this->getJson("{$this->path_prefix}/actors/{$this->actor->id}");
        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'name'      => $this->actor->name,
                'dob'       => date('Y-m-d', strtotime($this->actor->dob)),
                'image_url' => $this->actor->image_url,
            ],
            'message'   => "Successfully fetched actor"
        ]);
    }

    public function test_fetching_a_specific_actor_that_does_not_exist()
    {
        $this->flushActors();
        $param = 1337;
        $response = $this->getJson("{$this->path_prefix}/actors/{$param}");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find actor matching ID {$param}"
        ]);
    }

    public function test_creating_an_actor_successfully()
    {
        $this->flushActors();
        $actor_data = [
            'name'      => "New Character",
            'dob'       => date('Y-m-d', strtotime("1997-09-06")),
            'image_url' => "https://cdn.pixabay.com/photo/2012/04/18/00/07/silhouette-of-a-man-36181_1280.png"
        ];
        $response = $this->postJson(
            "{$this->path_prefix}/actors",
            $actor_data,
            $this->headers
        );
        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'name'      => $actor_data['name'],
                'dob'       => date('Y-m-d', strtotime($actor_data['dob'])),
                'image_url' => $actor_data['image_url'],
            ],
            'message'   => "Successully created new actor"
        ]);
        $this->assertDatabaseCount('actors', 1);
        $this->assertDatabaseHas('actors', [
            'name'      => $actor_data['name'],
            'dob'       => date('Y-m-d', strtotime($actor_data['dob'])),
            'image_url' => $actor_data['image_url'],
        ]);
    }

    public function test_creating_an_actor_with_invalid_data()
    {
        $this->flushActors();
        $actor_data = [
            'name'      => 123,
            'dob'       => 456,
            'image_url' => 789
        ];
        $response = $this->postJson(
            "{$this->path_prefix}/actors",
            $actor_data,
            $this->headers
        );
        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('actors', 0);
        $this->assertDatabaseMissing('actors', [
            'name'      => $actor_data['name'],
            'dob'       => date('Y-m-d', strtotime($actor_data['dob'])),
            'image_url' => $actor_data['image_url'],
        ]);
    }

    public function test_updating_an_actor_successfully()
    {
        $this->flushActors();
        $this->createActor();
        $actor_data = [
            'name'      => "New Character",
            'dob'       => date('Y-m-d', strtotime("1997-09-06")),
            'image_url' => "https://cdn.pixabay.com/photo/2012/04/18/00/07/silhouette-of-a-man-36181_1280.png"
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/actors/{$this->actor->id}",
            $actor_data,
            $this->headers
        );
        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'id'        => $this->actor->id,
                'name'      => $actor_data['name'],
                'dob'       => date('Y-m-d', strtotime($actor_data['dob'])),
                'image_url' => $actor_data['image_url'],
            ],
            'message'   => "Successfully updated actor"
        ]);
        $this->assertDatabaseHas('actors', [
            'name'      => $actor_data['name'],
            'dob'       => date('Y-m-d', strtotime($actor_data['dob'])),
            'image_url' => $actor_data['image_url'],
        ]);
    }

    public function test_updating_an_actor_that_does_not_exist()
    {
        $this->flushActors();
        $param = 1337;
        $actor_data = [
            'name'      => "New Character",
            'dob'       => date('Y-m-d', strtotime("1997-09-06")),
            'image_url' => "https://cdn.pixabay.com/photo/2012/04/18/00/07/silhouette-of-a-man-36181_1280.png"
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/actors/{$param}",
            $actor_data,
            $this->headers
        );
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No actor found matching ID {$param}"
        ]);
        $this->assertDatabaseMissing('actors', [
            'name'      => $actor_data['name'],
            'dob'       => date('Y-m-d', strtotime($actor_data['dob'])),
            'image_url' => $actor_data['image_url'],
        ]);
    }

    public function test_updating_an_actor_with_invalid_data()
    {
        $this->flushActors();
        $this->createActor();
        $actor_data = [
            'name'      => 123,
            'dob'       => 456,
            'image_url' => 789
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/actors/{$this->actor->id}",
            $actor_data,
            $this->headers
        );
        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseMissing('actors', [
            'name'      => $actor_data['name'],
            'dob'       => date('Y-m-d', strtotime($actor_data['dob'])),
            'image_url' => $actor_data['image_url'],
        ]);
    }

    public function test_deleting_an_actor_successfully()
    {
        $this->flushActors();
        $this->createActor();
        $actor = $this->actor;
        $response = $this->deleteJson(
            "{$this->path_prefix}/actors/{$this->actor->id}",
            [],
            $this->headers
        );
        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => "Successfully deleted actor matching ID {$actor->id}"
        ]);
        $this->assertDatabaseCount('actors', 0);
        $this->assertDatabaseMissing('actors', [
            'name'      => $actor->name,
            'dob'       => date('Y-m-d', strtotime($actor->dob)),
            'image_url' => $actor->image_url,
        ]);
    }

    public function test_deleting_an_actor_that_does_not_exist()
    {
        $this->flushActors();
        $this->createActor();
        $param = 1337;
        $response = $this->deleteJson(
            "{$this->path_prefix}/actors/{$param}",
            [],
            $this->headers
        );
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No actor found matching ID {$param}"
        ]);
        $this->assertDatabaseCount('actors', 1);
        $this->assertDatabaseHas('actors', [
            'name'      => $this->actor->name,
            'dob'       => date('Y-m-d', strtotime($this->actor->dob)),
            'image_url' => $this->actor->image_url,
        ]);
    }
}
