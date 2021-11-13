<?php

namespace Tests\Feature\Api;

use Tests\ApiTest;

class ComicBookTest extends ApiTest
{
    public function test_fetching_all_comic_books_successfully()
    {
        $response = $this->getJson("{$this->path_prefix}/comics");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_all_comic_books_where_none_exist()
    {
        $this->flushComicBooks();
        $response = $this->getJson("{$this->path_prefix}/comics");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No comics could be found in the database"
        ]);
    }

    public function test_fetching_a_specific_comic_book_successfully()
    {
        $this->flushComicBooks();
        $this->createComicBook();
        $response = $this->getJson("{$this->path_prefix}/comics/{$this->comic_book->id}");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
    }

    public function test_fetching_a_specific_comic_book_that_does_not_exists()
    {
        $this->flushComicBooks();
        $param = 1337;
        $response = $this->getJson("{$this->path_prefix}/comics/{$param}");
        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Failed to find a comic book matching ID {$param}"
        ]);
    }

    public function test_creating_a_comic_book_successfully()
    {
        $this->flushComicBooks();
        $comic_book_data = [
            "title"         => "Testing Comic",
            "description"   => "Testing Comic Description",
            "release_date"  => date("Y-m-d", strtotime(date(now()))),
        ];

        $response = $this->postJson(
            "{$this->path_prefix}/comics",
            $comic_book_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_books', 1);
        $this->assertDatabaseHas('comic_books', [
            'title'         => $comic_book_data['title'],
            'description'   => $comic_book_data['description'],
            'release_date'  => date("Y-m-d", strtotime($comic_book_data['release_date']))
        ]);
    }

    public function test_creating_a_comic_book_with_invalid_data()
    {
        $this->flushComicBooks();
        $comic_book_data = [
            "description"   => "Testing Comic Description",
            "release_date"  => date("Y-m-d", strtotime(date(now()))),
        ];

        $response = $this->postJson(
            "{$this->path_prefix}/comics",
            $comic_book_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_books', 0);
        $this->assertDatabaseMissing('comic_books', [
            'description'   => $comic_book_data['description'],
            'release_date'  => date("Y-m-d", strtotime($comic_book_data['release_date']))
        ]);
    }

    public function test_updating_a_comic_book_successfully()
    {
        $this->flushComicBooks();
        $this->createComicBook();
        $comic_book_data = [
            "title"         => "Updated Comic",
            "description"   => "Updated Comic Description",
            "release_date"  => date("Y-m-d", strtotime(date(now()))),
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/comics/{$this->comic_book->id}",
            $comic_book_data,
            $this->headers
        );

        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_books', 1);
        $this->assertDatabaseHas('comic_books', [
            'title'         => $comic_book_data['title'],
            'description'   => $comic_book_data['description'],
            'release_date'  => date("Y-m-d", strtotime($comic_book_data['release_date']))
        ]);
    }

    public function test_updating_a_comic_book_that_does_not_exist()
    {
        $this->flushComicBooks();
        $param = 1337;
        $comic_book_data = [
            "title"         => "Testing Comic",
            "description"   => "Testing Comic Description",
            "release_date"  => date("Y-m-d", strtotime(date(now()))),
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/comics/{$param}",
            $comic_book_data,
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_books', 0);
        $this->assertDatabaseMissing('comic_books', [
            'title'         => $comic_book_data['title'],
            'description'   => $comic_book_data['description'],
            'release_date'  => date("Y-m-d", strtotime($comic_book_data['release_date']))
        ]);
    }

    public function test_updating_a_comic_book_with_invalid_data()
    {
        $this->flushComicBooks();
        $this->createComicBook();
        $comic_book_data = [
            "title"         => 123,
            "description"   => 456,
            "release_date"  => 789,
        ];

        $response = $this->putJson(
            "{$this->path_prefix}/comics/{$this->comic_book->id}",
            $comic_book_data,
            $this->headers
        );

        $response->assertStatus(400);
        $response->assertJsonStructure(['data', 'message']);
        $this->assertDatabaseCount('comic_books', 1);
        $this->assertDatabaseMissing('comic_books', [
            'title'         => $comic_book_data['title'],
            'description'   => $comic_book_data['description'],
            'release_date'  => date("Y-m-d", strtotime($comic_book_data['release_date']))
        ]);
    }

    public function test_deleting_a_comic_book_succesfully()
    {
        $this->flushComicBooks();
        $this->createComicBook();
        $response = $this->deleteJson(
            "{$this->path_prefix}/comics/{$this->comic_book->id}",
            [],
            $this->headers
        );

        $response->assertOk();
        $response->assertJson([
            'data'      => null,
            'message'   => 'Successfully deleted comic book'
        ]);
        $this->assertDatabaseCount('comic_books', 0);
    }

    public function test_deleting_a_comic_book_does_not_exist()
    {
        $this->flushComicBooks();
        $this->createComicBook();
        $param = 1337;
        $response = $this->deleteJson(
            "{$this->path_prefix}/comics/{$param}",
            [],
            $this->headers
        );

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "No comic book found matching ID {$param}"
        ]);
        $this->assertDatabaseCount('comic_books', 1);
        $this->assertDatabaseHas('comic_books', [
            'title'         => $this->comic_book->title,
            'description'   => $this->comic_book->description,
            'release_date'  => $this->comic_book->release_date,
        ]);
    }
}
