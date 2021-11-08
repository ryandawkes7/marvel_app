<?php

namespace Tests\Feature\Api;

use Tests\ApiTest;

class DirectorTest extends ApiTest
{
    public function test_fetching_all_directors_successfully()
    {
        $response = $this->getJson("{$this->path_prefix}/directors");

        $response->assertOk();
        $response->assertJsonCount(3, 'data');
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_all_directors_where_none_exist()
    {
        $this->flushDirectors();
        $response = $this->getJson("{$this->path_prefix}/directors");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => [],
            'message'   => "Could not find any directors in the database"
        ]);
    }

    public function test_fetching_a_specific_director_successfully()
    {
        $this->flushDirectors();
        $this->createDirector();
        $response = $this->getJson("{$this->path_prefix}/directors/{$this->director->id}");

        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'id'    => $this->director->id,
                'name'  => $this->director->name,
                'dob'   => date('Y-m-d', strtotime($this->director->dob)),
                'image' => $this->director->image
            ],
            'message'   => 'Successfully fetched specified character'
        ]);
    }

    public function test_fetching_a_specific_director_where_matching_director_does_not_exist()
    {
        $this->flushDirectors();
        $param = 1337;
        $response = $this->getJson("{$this->path_prefix}/directors/{$param}");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find director matching ID {$param}"
        ]);
    }

    public function test_creating_a_director_successfully()
    {
        $this->flushDirectors();
        $director_data = [
            'name'  => "Testing",
            'dob'   => date("Y-m-d", strtotime('1966-08-05')),
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/James_Gunn_%2828557194032%29_%28cropped%29.jpg/1024px-James_Gunn_%2828557194032%29_%28cropped%29.jpg'
        ];

        $response = $this->postJson(
            "{$this->path_prefix}/directors",
            $director_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'name'  => $director_data['name'],
                'dob'   => date("Y-m-d", strtotime($director_data['dob'])),
                'image' => $director_data['image']
            ],
            'message'   => "Successfully created director"
        ]);
        $this->assertDatabaseCount('directors', 1);
        $this->assertDatabaseHas('directors', [
            'name'  => $director_data['name'],
            'dob'   => date("Y-m-d", strtotime($director_data['dob'])),
            'image' => $director_data['image']
        ]);
    }

    public function test_creating_a_director_with_invalid_data()
    {
        $this->flushDirectors();
        $director_data = [
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/James_Gunn_%2828557194032%29_%28cropped%29.jpg/1024px-James_Gunn_%2828557194032%29_%28cropped%29.jpg'
        ];

        $response = $this->postJson(
            "{$this->path_prefix}/directors",
            $director_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('directors', 0);
        $this->assertDatabaseMissing('directors', [
            'image' => $director_data['image']
        ]);
    }

    public function test_updating_a_director_succesfully()
    {
        $this->flushDirectors();
        $this->createDirector();

        $update_data = [
            'name'  => "Updated Data",
            'dob'   => date("Y-m-d", strtotime('2000-12-25')),
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Ryan_Coogler_by_Gage_Skidmore.jpg/1024px-Ryan_Coogler_by_Gage_Skidmore.jpg'
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/directors/{$this->director->id}",
            $update_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'name'  => $update_data['name'],
                'dob'   => date("Y-m-d", strtotime($update_data['dob'])),
                'image' => $update_data['image']
            ],
            'message' => "Successfully updated movie director"
        ]);
        $this->assertDatabaseHas('directors', [
            'name'  => $update_data['name'],
            'dob'   => date("Y-m-d", strtotime($update_data['dob'])),
            'image' => $update_data['image']
        ]);
    }

    public function test_updating_a_director_with_invalid_data()
    {
        $this->flushDirectors();
        $this->createDirector();

        $update_data = [
            'name'  => "Updated Data",
            'dob'   => 12345,
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7'
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/directors/{$this->director->id}",
            $update_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseHas('directors', [
            'name'  => $this->director->name,
            'dob'   => date("Y-m-d", strtotime($this->director->dob)),
            'image' => $this->director->image
        ]);
        $this->assertDatabaseMissing('directors', [
            'name'  => $update_data['name'],
            'dob'   => date("Y-m-d", strtotime($update_data['dob'])),
            'image' => $update_data['image']
        ]);
    }

    public function test_updating_a_director_that_does_not_exist()
    {
        $this->flushDirectors();
        $param = 1337;

        $update_data = [
            'name'  => "Updated Data",
            'dob'   => date("Y-m-d", strtotime('2000-12-25')),
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Ryan_Coogler_by_Gage_Skidmore.jpg/1024px-Ryan_Coogler_by_Gage_Skidmore.jpg'
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/directors/{$param}",
            $update_data,
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data' => null,
            'message' => "Could not find movie director matching ID {$param}"
        ]);
        $this->assertDatabaseMissing('directors', [
            'name'  => $update_data['name'],
            'dob'   => date("Y-m-d", strtotime($update_data['dob'])),
            'image' => $update_data['image']
        ]);
    }

    public function test_deleting_a_director_successfully()
    {
        $this->flushDirectors();
        $this->createDirector();

        $response = $this->deleteJson(
            "{$this->path_prefix}/directors/{$this->director->id}",
            [],
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => 'Successfully removed director'
        ]);
        $this->assertDatabaseCount('directors', 0);
        $this->assertDatabaseMissing('directors', [
            'name'  => $this->director->name,
            'dob'   => date("Y-m-d", strtotime($this->director->dob)),
            'image' => $this->director->image,
        ]);
    }
    
    public function test_deleting_a_director_where_director_does_not_exist()
    {
        $this->flushDirectors();
        $this->createDirector();
        $param = 1337;

        $response = $this->deleteJson(
            "{$this->path_prefix}/directors/{$param}",
            [],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No director found matching ID {$param}"
        ]);
        $this->assertDatabaseCount('directors', 1);
        $this->assertDatabaseHas('directors', [
            'name'  => $this->director->name,
            'dob'   => date("Y-m-d", strtotime($this->director->dob)),
            'image' => $this->director->image,
        ]);
    }
}
