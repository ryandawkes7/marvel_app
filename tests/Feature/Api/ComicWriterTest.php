<?php

namespace Tests\Feature\Api;

use Tests\ApiTest;

class ComicWriterTest extends ApiTest
{
    public function test_fetching_all_comic_writers_successfully()
    {
        $response = $this->getJson("{$this->path_prefix}/comic-writers");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }
    
    public function test_fetching_all_comic_writers_where_none_exist()
    {
        $this->flushComicWriters();
        $response = $this->getJson("{$this->path_prefix}/comic-writers");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null, 
            'message'   => "No comic writers found"
        ]);
    }

    public function test_fetching_a_specific_comic_writer_successfully()
    {
        $this->flushComicWriters();
        $this->createComicWriter();
        $response = $this->getJson("{$this->path_prefix}/comic-writers/{$this->comic_writer->id}");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }
    
    public function test_fetching_a_specific_comic_writer_where_none_exist()
    {
        $this->flushComicWriters();
        $param = 1337;
        $response = $this->getJson("{$this->path_prefix}/comic-writers/{$param}");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find writer matching ID {$param}"
        ]);
    }
    
    public function test_creating_a_comic_writer_successfully()
    {
        $this->flushComicWriters();
        $writer_data = [
            'name'  => 'Stan Lee',
            'dob'   => date("Y-m-d", strtotime("1997-09-06")),
            'image' => "https://upload.wikimedia.org/wikipedia/commons/7/7b/Stan_Lee_by_Gage_Skidmore_3.jpg"
        ];
        $response = $this->postJson(
            "{$this->path_prefix}/comic-writers",
            $writer_data,
            $this->headers
        );
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_writers', 1);
        $this->assertDatabaseHas('comic_writers', [
            'name'  => $writer_data['name'],
            'dob'   => date("Y-m-d", strtotime($writer_data['dob'])),
            'image' => $writer_data['image']
        ]);
    }
    
    public function test_creating_a_comic_writer_with_invalid_data()
    {
        $this->flushComicWriters();
        $writer_data = [
            'dob'   => date("Y-m-d", strtotime("1997-09-06")),
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Stan_Lee_by_Gage_Skidmore_3.jpg'
        ];
        $response = $this->postJson(
            "{$this->path_prefix}/comic-writers",
            $writer_data,
            $this->headers
        );
        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_writers', 0);
        $this->assertDatabaseMissing('comic_writers', [
            'dob'   => date("Y-m-d", strtotime($writer_data['dob'])),
            'image' => $writer_data['image']
        ]);
    }
    
    public function test_updating_a_comic_writer_successfully()
    {
        $this->flushComicWriters();
        $this->createComicWriter();
        $writer_data = [
            'name'  => 'Updated Writer',
            'dob'   => date("Y-m-d", strtotime("1997-09-06")),
            'image' => null
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/comic-writers/{$this->comic_writer->id}",
            $writer_data,
            $this->headers
        );
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_writers', 1);
        $this->assertDatabaseHas('comic_writers', [
            'name'  => $writer_data['name'],
            'dob'   => date("Y-m-d", strtotime($writer_data['dob'])),
            'image' => $writer_data['image']
        ]);
    }
    
    public function test_updating_a_comic_writer_with_invalid_data()
    {
        $this->flushComicWriters();
        $this->createComicWriter();
        $writer_data = [
            'name'  => 123,
            'dob'   => 456,
            'image' => 789
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/comic-writers/{$this->comic_writer->id}",
            $writer_data,
            $this->headers
        );
        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_writers', 1);
        $this->assertDatabaseMissing('comic_writers', [
            'name'  => $writer_data['name'],
            'dob'   => date("Y-m-d", strtotime($writer_data['dob'])),
            'image' => $writer_data['image']
        ]);
    }

    public function test_updating_a_comic_writer_that_cannot_be_found()
    {
        $this->flushComicWriters();
        $this->createComicWriter();
        $param = 1337;
        $writer_data = [
            'name'  => 'Stan Lee',
            'dob'   => date("Y-m-d", strtotime("1997-09-06")),
            'image' => "https://upload.wikimedia.org/wikipedia/commons/7/7b/Stan_Lee_by_Gage_Skidmore_3.jpg"
        ];
        $response = $this->putJson(
            "{$this->path_prefix}/comic-writers/{$param}",
            $writer_data,
            $this->headers
        );
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find comic writer matching ID {$param}"
        ]);
        $this->assertDatabaseCount('comic_writers', 1);
        $this->assertDatabaseMissing('comic_writers', [
            'name'  => $writer_data['name'],
            'dob'   => date("Y-m-d", strtotime($writer_data['dob'])),
            'image' => $writer_data['image']
        ]);
    }
    
    public function test_deleting_a_comic_writer_successfully()
    {
        $this->flushComicWriters();
        $this->createComicWriter();
        $response = $this->deleteJson(
            "{$this->path_prefix}/comic-writers/{$this->comic_writer->id}",
            [],
            $this->headers
        );
        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => "Successfully deleted comic writer"
        ]);
        $this->assertDatabaseCount('comic_writers', 0);
        $this->assertDatabaseMissing('comic_writers', [
            'name'  => $this->comic_writer->name,
            'dob'   => date("Y-m-d", strtotime($this->comic_writer->dob)),
            'image' => $this->comic_writer->image
        ]);
    }
    
    public function test_deleting_a_comic_writer_that_does_not_exist()
    {
        $this->flushComicWriters();
        $this->createComicWriter();
        $param = 1337;
        $response = $this->deleteJson(
            "{$this->path_prefix}/comic-writers/{$param}",
            [],
            $this->headers
        );
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No comic writer found matching ID {$param}"
        ]);
        $this->assertDatabaseCount('comic_writers', 1);
        $this->assertDatabaseHas('comic_writers', [
            'name'  => $this->comic_writer->name,
            'dob'   => date("Y-m-d", strtotime($this->comic_writer->dob)),
            'image' => $this->comic_writer->image
        ]);
    }
}
