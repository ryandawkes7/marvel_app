<?php

namespace Tests\Feature\Api;

use Tests\ApiTest;

class SagaTest extends ApiTest
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetching_all_sagas()
    {
        $response = $this->getJson("{$this->path_prefix}/sagas");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_all_sagas_when_there_are_no_saga_records_in_db()
    {
        $this->flushSagas();
        $response = $this->getJson("{$this->path_prefix}/sagas");
        
        $response->assertNotFound();
        $response->assertJson([
            'data' => null,
            'message' => "No sagas could be found"
        ]);
        $this->assertDatabaseCount('movie_sagas', 0);
    }
}
