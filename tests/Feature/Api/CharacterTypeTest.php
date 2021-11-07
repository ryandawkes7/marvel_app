<?php

namespace Tests\Feature\Api;

use App\Models\CharacterType;
use Tests\ApiTest;

class CharacterTypeTest extends ApiTest
{
    public function test_fetching_all_character_types()
    {
        $response = $this->getJson("{$this->path_prefix}/character-types");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_all_character_types_when_none_exist()
    {
        $this->flushCharacterTypes();
        $response = $this->getJson("{$this->path_prefix}/character-types");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find any character types in the database"
        ]);
    }

    public function test_fetching_a_specific_character_type()
    {
        $this->flushCharacterTypes();
        $this->createCharacterType();
        $response = $this->getJson("{$this->path_prefix}/character-types/{$this->type->key}");

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id'    => $this->type->id,
                'key'   => $this->type->key,
                'type'  => $this->type->type
            ],
            'message' => "Successfully fetched character type"
        ]);
    }

    public function test_fetching_a_specific_character_type_that_does_not_exist()
    {
        $this->flushCharacterTypes();
        $path = "testing";
        $response = $this->getJson("{$this->path_prefix}/character-types/{$path}");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No type matching the key {$path}"
        ]);
    }

    public function test_fetching_a_specific_character_type_with_invalid_search_data()
    {
        $this->flushCharacterTypes();
        $path = "1nval1d";
        $response = $this->getJson("{$this->path_prefix}/character-types/{$path}");

        $response->assertStatus(400);
        $response->assertJson([
            'data'      => null,
            'message'   => "The key parameter should be of type string"
        ]);
    }

    public function test_creating_a_new_character_type_successfully()
    {
        $this->flushCharacterTypes();
        $type_data = [
            'key'   => 'testing',
            'type'  => 'Testing'
        ];

        $response = $this->postJson(
            "{$this->path_prefix}/character-types",
            $type_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('character_types', 1);
        $this->assertDatabaseHas('character_types', [
            'key'   => $type_data['key'],
            'type'  => $type_data['type']
        ]);
    }

    public function test_creating_a_new_character_type_with_invalid_data()
    {
        $this->flushCharacterTypes();
        $type_data = [
            'key'   => 'testing',
        ];

        $response = $this->postJson(
            "{$this->path_prefix}/character-types",
            $type_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseMissing('character_types', [
            'key' => $type_data['key']
        ]);
    }

    public function test_updating_a_character_type_successfully()
    {
        $this->flushCharacterTypes();
        $this->createCharacterType();

        $update_data = [
            'key'   => $this->type->key,
            'type' => 'Updated'
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/character-types/{$this->type->key}",
            $update_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id'    => $this->type->id,
                'key'   => $update_data['key'],
                'type'  => $update_data['type']
            ],
            'message' => "Successfully updated character type"
        ]);
        $this->assertDatabaseHas('character_types', [
            'key'   => $update_data['key'],
            'type'  => $update_data['type']
        ]);
    }

    public function test_updating_a_character_type_with_invalid_data()
    {
        $this->flushCharacterTypes();
        $this->createCharacterType();

        $response = $this->putJson(
            "{$this->path_prefix}/character-types/{$this->type->key}",
            [],
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseHas('character_types', [
            'key'   => $this->type->key,
            'type'  => $this->type->type
        ]);
    }

    public function test_updating_a_character_type_that_does_not_exist()
    {
        $this->flushCharacterTypes();
        $this->createCharacterType();

        $update_data = [
            'key'   => $this->type->key,
            'type' => 'Updated'
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/character-types/broken",
            $update_data,
            $this->headers
        );

        $response->assertStatus(404);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseHas('character_types', [
            'key'   => $this->type->key,
            'type'  => $this->type->type
        ]);
        $this->assertDatabaseMissing('character_types', [
            'key'   => $update_data['key'],
            'type'  => $update_data['type'],
        ]);
    }

    public function test_updating_a_character_type_where_parameter_is_invalid()
    {
        $this->flushCharacterTypes();
        $this->createCharacterType();

        $update_data = [
            'key'   => $this->type->key,
            'type' => 'Updated'
        ];
        $param = 1337;

        $response = $this->putJson(
            "{$this->path_prefix}/character-types/{$param}",
            $update_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJson([
            'data'      => null,
            'message'   => "The key parameter should be of type string"
        ]);
        $this->assertDatabaseHas('character_types', [
            'key'   => $this->type->key,
            'type'  => $this->type->type
        ]);
        $this->assertDatabaseMissing('character_types', [
            'key'   => $update_data['key'],
            'type'  => $update_data['type'],
        ]);
    }

    public function test_deleting_a_character_type_successfully()
    {
        $this->flushCharacterTypes();
        $this->createCharacterType();
        $response = $this->deleteJson(
            "{$this->path_prefix}/character-types/{$this->type->key}",
            [],
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => "Successfully deleted character type"
        ]);
        $this->assertDatabaseCount('character_types', 0);
    }

    public function test_deleting_a_characteer_type_with_invalid_parameter()
    {
        $this->flushCharacterTypes();
        $this->createCharacterType();
        $response = $this->deleteJson(
            "{$this->path_prefix}/character-types/1337",
            [],
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJson([
            'data'      => null,
            'message'   => "The key parameter should be of type string"
        ]);
        $this->assertDatabaseCount('character_types', 1);
        $this->assertDatabaseHas('character_types', [
            'key'   => $this->type->key,
            'type'  => $this->type->type
        ]);
    }

    public function test_deleting_a_character_type_that_does_not_exist()
    {
        $this->flushCharacterTypes();
        $this->createCharacterType();
        $param = "broken";
        $response = $this->deleteJson(
            "{$this->path_prefix}/character-types/{$param}",
            [],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find type matching key {$param}"
        ]);
        $this->assertDatabaseCount('character_types', 1);
        $this->assertDatabaseHas('character_types', [
            'key'   => $this->type->key,
            'type'  => $this->type->type
        ]);
    }
}
