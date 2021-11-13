<?php

namespace Tests\Feature\Api;

use Tests\ApiTest;

class PhaseTest extends ApiTest
{
    public function test_fetching_all_phases_successfully()
    {
        $response = $this->getJson("{$this->path_prefix}/phases");

        $response->assertOk();
        $response->assertJsonCount(4, 'data');
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_all_phases_where_none_exist()
    {
        $this->flushPhases();
        $response = $this->getJson("{$this->path_prefix}/phases");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => [],
            'message'   => "Could not find any phases in the database"
        ]);
    }

    public function test_fetching_a_specific_phase_successfully()
    {
        $this->flushPhases();
        $this->createPhase();
        $response = $this->getJson("{$this->path_prefix}/phases/{$this->phase->id}");

        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'id'    => $this->phase->id,
                'title' => $this->phase->title
            ],
            'message'   => 'Successfully fetched specified phase'
        ]);
    }

    public function test_fetching_a_specific_phase_where_matching_phase_does_not_exist()
    {
        $this->flushPhases();
        $param = 1337;
        $response = $this->getJson("{$this->path_prefix}/phases/{$param}");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find phase matching ID {$param}"
        ]);
    }

    public function test_creating_a_phase_successfully()
    {
        $this->flushPhases();
        $phase_data = ['title' => "New Phase"];

        $response = $this->postJson(
            "{$this->path_prefix}/phases",
            $phase_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => ['title' => $phase_data['title']],
            'message'   => "Successfully created phase"
        ]);
        $this->assertDatabaseCount('mcu_phases', 1);
        $this->assertDatabaseHas('mcu_phases', ['title' => $phase_data['title']]);
    }

    public function test_creating_a_phase_with_invalid_data()
    {
        $this->flushPhases();
        $phase_data = ['image' => null];

        $response = $this->postJson(
            "{$this->path_prefix}/phases",
            $phase_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('mcu_phases', 0);
    }

    public function test_updating_a_phase_succesfully()
    {
        $this->flushPhases();
        $this->createPhase();

        $update_data = ['title' => "Updated Phase"];

        $response = $this->putJson(
            "{$this->path_prefix}/phases/{$this->phase->id}",
            $update_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data' => ['title' => $update_data['title']],
            'message' => "Successfully updated movie phase"
        ]);
        $this->assertDatabaseHas('mcu_phases', ['title' => $update_data['title']]);
    }

    public function test_updating_a_phase_with_invalid_data()
    {
        $this->flushPhases();
        $this->createPhase();

        $update_data = ['title' => null];

        $response = $this->putJson(
            "{$this->path_prefix}/phases/{$this->phase->id}",
            $update_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseHas('mcu_phases', ['title' => $this->phase->title]);
        $this->assertDatabaseMissing('mcu_phases', ['title' => $update_data['title']]);
    }

    public function test_updating_a_phase_that_does_not_exist()
    {
        $this->flushPhases();
        $param = 1337;
        $update_data = ['title' => 'Updated data'];

        $response = $this->putJson(
            "{$this->path_prefix}/phases/{$param}",
            $update_data,
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data' => null,
            'message' => "Could not find movie phase matching ID {$param}"
        ]);
        $this->assertDatabaseMissing('mcu_phases', ['title' => $update_data['title']]);
    }

    public function test_deleting_a_phase_successfully()
    {
        $this->flushPhases();
        $this->createPhase();

        $response = $this->deleteJson(
            "{$this->path_prefix}/phases/{$this->phase->id}",
            [],
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => 'Successfully removed phase'
        ]);
        $this->assertDatabaseCount('mcu_phases', 0);
        $this->assertDatabaseMissing('mcu_phases', ['title' => $this->phase->title]);
    }
    
    public function test_deleting_a_phase_where_phase_does_not_exist()
    {
        $this->flushPhases();
        $this->createPhase();
        $param = 1337;

        $response = $this->deleteJson(
            "{$this->path_prefix}/phases/{$param}",
            [],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No phase found matching ID {$param}"
        ]);
        $this->assertDatabaseCount('mcu_phases', 1);
        $this->assertDatabaseHas('mcu_phases', ['title' => $this->phase->title]);
    }
}
