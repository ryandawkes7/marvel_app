<?php

namespace Tests\Feature\Api;

use App\Models\Character;
use Tests\ApiTest;

class CharacterTest extends ApiTest
{
    public function test_fetching_all_characters()
    {
        $this->createCharacter();
        $response = $this->getJson("{$this->path_prefix}/characters");

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_all_characters_where_none_exist()
    {
        $this->flushCharacters();
        $response = $this->getJson("{$this->path_prefix}/characters");

        $response->assertNotFound();
        $response->assertExactJson([
            'data'      => null,
            'message'   => 'No characters found in database'
        ]);
        $this->assertDatabaseCount('characters', 0);
    }

    public function test_fetching_a_specific_character()
    {
        $this->flushCharacters();
        $this->createCharacter();
        
        $response = $this->getJson("{$this->path_prefix}/characters/{$this->character->id}");

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_a_character_that_does_not_exist()
    {
        $this->flushCharacters();
        $response = $this->getJson("{$this->path_prefix}/characters/1337");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No character found matching ID 1337"
        ]);
    }

    public function test_creating_a_character_successfully()
    {
        $this->flushCharacters();

        $character_data = [
            "alias"     => "Testing Alias",
            "sex"       => "unknown",
            "morality"  => "neutral",
            "skills"    => [
                ["key" => "durability", "value" => 4],
                ["key" => "energy_projection", "value" => 3],
                ["key" => "fighting_skills", "value" => 8],
                ["key" => "intelligence", "value" => 5],
                ["key" => "speed", "value" => 4],
                ["key" => "strength", "value" => 2]
            ]
        ];

        $response = $this->postJson(
            "{$this->path_prefix}/characters",
            $character_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('characters', 1);
        $this->assertDatabaseHas('characters', [
            'alias'     => $character_data['alias'],
            'sex'       => $character_data['sex'],
            'morality'  => $character_data['morality']
        ]);
    }

    public function test_creating_a_character_with_invalid_data()
    {
        $this->flushCharacters();
        $response = $this->postJson(
            "{$this->path_prefix}/characters",
            [],
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('characters', 0);
    }

    public function test_updating_a_character_instance_successfully()
    {
        $this->flushCharacters();
        $this->createCharacter();

        $update_data = [
            'alias'     => 'Updated Character',
            'sex'       => 'none',
            'morality'  => 'hero',
            'skills'    => [
                ["key" => "durability",         "value" => 9],
                ["key" => "energy_projection",  "value" => 9],
                ["key" => "fighting_skills",    "value" => 9],
                ["key" => "intelligence",       "value" => 9],
                ["key" => "speed",              "value" => 9],
                ["key" => "strength",           "value" => 9]
            ]
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/characters/{$this->character->id}",
            $update_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('characters', 1);
        $this->assertDatabaseCount('character_skill', 6);
        $this->assertDatabaseHas('characters', [
            'id'        => $this->character->id,
            'alias'     => $update_data['alias'],
            'morality'  => $update_data['morality'],
        ]);
        $this->assertDatabaseHas('character_skill', [
            'character_id'  => $this->character->id,
            'skill_id'      => 1,
            'skill_id'      => 2,
            'skill_id'      => 3,
            'skill_id'      => 4,
            'skill_id'      => 5,
            'skill_id'      => 6
        ]);
    }

    public function test_updating_a_character_instance_with_invalid_data()
    {
        $this->flushCharacters();
        $this->createCharacter();

        $update_data = [
            'alias'     => 'Updated Character',
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/characters/{$this->character->id}",
            $update_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseMissing('characters', [
            'alias' => $update_data['alias']
        ]);
    }

    public function test_updating_a_character_instance_where_character_cannot_be_found()
    {
        $this->flushCharacters();

        $update_data = [
            'alias'     => 'Updated Character',
            'sex'       => 'none',
            'morality'  => 'hero',
            'skills'    => [
                ["key" => "durability",         "value" => 9],
                ["key" => "energy_projection",  "value" => 9],
                ["key" => "fighting_skills",    "value" => 9],
                ["key" => "intelligence",       "value" => 9],
                ["key" => "speed",              "value" => 9],
                ["key" => "strength",           "value" => 9]
            ]
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/characters/1337",
            $update_data,
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('characters', 0);
        $this->assertDatabaseMissing('characters', [
            'alias' => $update_data['alias']
        ]);
    }

    public function test_deleting_a_character_instance_successfully()
    {
        $this->flushCharacters();
        $this->createCharacter();
        $response = $this->deleteJson(
            "{$this->path_prefix}/characters/{$this->character->id}",
            [],
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => 'Successfully deleted character'
        ]);
        $this->assertDatabaseCount('characters', 0);
        $this->assertDatabaseCount('character_skill', 0);
    }

    public function test_deleting_a_non_existant_character()
    {
        $this->flushCharacters();
        $this->createCharacter();
        $response = $this->deleteJson(
            "{$this->path_prefix}/characters/1337",
            [],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find character matching ID 1337"
        ]);
        $this->assertDatabaseCount('characters', 1);
    }
}
