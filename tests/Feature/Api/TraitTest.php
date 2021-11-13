<?php

namespace Tests\Feature\Api;

use Tests\ApiTest;

class TraitTest extends ApiTest
{
    public function test_fetching_all_traits_successfully()
    {
        $response = $this->getJson("{$this->path_prefix}/traits");

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $response->assertJsonCount(3, 'data');
    }

    public function test_fetching_all_traits_where_none_exist()
    {
        $this->flushTraits();
        $response = $this->getJson("{$this->path_prefix}/traits");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => [],
            'message'   => "Could not find any traits in the database"
        ]);
    }

    public function test_fetching_a_specific_trait_successfully()
    {
        $this->flushTraits();
        $this->createTrait();
        $response = $this->getJson("{$this->path_prefix}/traits/{$this->trait->id}");

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $this->trait->id,
                'name' => $this->trait->name,
                'description' => $this->trait->description
            ],
            'message' => "Successfully fetched trait"
        ]);
        $response->assertJsonCount(3, 'data');
    }

    public function test_fetching_a_specific_trait_that_does_not_exist()
    {
        $this->flushTraits();
        $param = 1337;
        $response = $this->getJson("{$this->path_prefix}/traits/{$param}");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No trait matching ID {$param}"
        ]);
    }

    public function test_creating_a_trait_successfully()
    {
        $this->flushTraits();
        $trait_data = [
            'name' => "Created data",
            'description' => "Created description"
        ];
        $response = $this->postJson(
            "{$this->path_prefix}/traits",
            $trait_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('traits', 1);
        $this->assertDatabaseHas('traits', [
            'name'          => $trait_data['name'],
            'description'   => $trait_data['description']
        ]);
    }

    public function test_creating_a_trait_with_invalid_data()
    {
        $this->flushTraits();
        $trait_data = [
            'name' => "Created data",
        ];
        $response = $this->postJson(
            "{$this->path_prefix}/traits",
            $trait_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('traits', 0);
        $this->assertDatabaseMissing('traits', [
            'name'          => $trait_data['name']
        ]);
    }

    public function test_updating_an_existing_trait_successfully()
    {
        $this->flushTraits();
        $this->createTrait();

        $update_data = [
            'name'          => 'Updated name',
            'description'   => 'Updated description'
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/traits/{$this->trait->id}",
            $update_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonCount(3, 'data');
        $response->assertJson([
            'data' => [
                'id' => $this->trait->id,
                'name' => $update_data['name'],
                'description' => $update_data['description'],
            ],
            'message' => "Successfully updated trait"
        ]);
        $this->assertDatabaseHas('traits', [
            'name'          => $update_data['name'],
            'description'   => $update_data['description'],
        ]);
    }

    public function test_updating_an_existing_trait_where_trait_does_not_exist()
    {
        $this->flushTraits();
        $param = 1337;

        $update_data = [
            'name'          => 'Updated name',
            'description'   => 'Updated description'
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/traits/{$param}",
            $update_data,
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No trait found matching ID {$param}"
        ]);
        $this->assertDatabaseMissing('traits', [
            'name'          => $update_data['name'],
            'description'   => $update_data['description'],
        ]);
    }

    public function test_updating_an_existing_trait_with_invalid_data()
    {
        $this->flushTraits();
        $this->createTrait();

        $response = $this->putJson(
            "{$this->path_prefix}/traits/{$this->trait->id}",
            [],
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseHas('traits', [
            'name'          => $this->trait->name,
            'description'   => $this->trait->description
        ]);
    }

    public function test_deleting_a_trait_successfully()
    {
        $this->flushTraits();
        $this->createTrait();

        $response = $this->deleteJson(
            "{$this->path_prefix}/traits/{$this->trait->id}",
            [],
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => "Successfully deleted trait"
        ]);
        $this->assertDatabaseCount('traits', 0);
        $this->assertDatabaseMissing('traits', [
            'id'            => $this->trait->id,
            'name'          => $this->trait->name,
            'description'   => $this->trait->description,
        ]);
    }

    public function test_deleting_a_trait_where_trait_does_not_exist()
    {
        $this->flushTraits();
        $this->createTrait();
        $param = 1337;

        $response = $this->deleteJson(
            "{$this->path_prefix}/traits/{$param}",
            [],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find trait matching ID {$param}"
        ]);
        $this->assertDatabaseCount('traits', 1);
        $this->assertDatabaseHas('traits', [
            'id'            => $this->trait->id,
            'name'          => $this->trait->name,
            'description'   => $this->trait->description,
        ]);
    }
}
