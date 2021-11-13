<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComicBookRequest;
use App\Http\Requests\UpdateComicBookRequest;
use App\Models\ComicBook;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ComicBooksController extends Controller
{
    /**
     * Render main page view
     */
    public function main_page()
    {
        return Inertia::render('Comics/Index');
    }

    /**
     * Return a specific comic
     */
    public function show_page()
    {
        return Inertia::render('Comics/Show');
    }

    /**
     * Fetch all comics
     *
     * @return JSON
     */
    public function index()
    {
        $comics = ComicBook::with('writers')
                            ->with('comicIssues')
                            ->with('covers')
                            ->get();

        // No comics in DB
        if (count($comics) <= 0) {
            Log::warning("No comics found in the database");
            return response()->json([
                'data' => [],
                'message' => "No comics could be found in the database"
            ], 404);
        }

        // Success response
        Log::info("Succesfully returned all comics in the database");
        return response()->json([
            'data' => $comics,
            'message' => 'Successfully fetched all comics'
        ], 200);
    }

    /**
     * Show a specific comic
     * 
     * @param integer $comic_id
     * @return \Illuminate\Http\Response
     */
    public function show($comic_id)
    {
        // No matching comic book
        if (!ComicBook::whereId($comic_id)->exists()) {
            Log::error("Failed to find matching comic book", ['comic_book' => null]);
            return response()->json([
                'data'      =>  null,
                'message'   => "Failed to find a comic book matching ID {$comic_id}"
            ], 404);
        }

        $comic_book = ComicBook::whereId($comic_id)
                            ->with('writers')
                            ->with('comicIssues')
                            ->with('covers')
                            ->first();

        // Success response
        Log::info("Successfully found matching comic book", ['comic_book' => $comic_book]);
        return response()->json([
            'data'      => $comic_book,
            'message'   => 'Successfully fetched matching comic book'
        ], 200);
    }

    /**
     * Store a newly created comic book in storage.
     *
     * @param  \App\Http\Requests\StoreComicBookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComicBookRequest $request)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $new_comic = ComicBook::create($request->validated());

        // Attach writer instance(s)
        if ($request->writers) {
            foreach ($request->writers as $writer) {
                $new_comic->writers()->attach($writer['id']);
            }
        }

        // Create comic issue instance(s) against this comic book

        if ($request->comic_issues) {
            foreach ($request->comic_issues as $issue) {
                $new_issue = $new_comic->comicIssues()->create([
                    'title'         => $issue['title'],
                    'description'   => $issue['description'],
                    'issue_number'  => $issue['issue_number'],
                    'volume_number' => $issue['volume_number'],
                    'release_date'  => $issue['release_date'],
                ]);

                // Attach character instance(s) to this issue
                if (!empty($issue['characters'])) {
                    foreach ($issue['characters'] as $character) {
                        $new_issue->characters()->attach($character['id']);
                    }
                }

                // Create cover instance(s) against this issue
                if (!empty($issue['covers'])) {
                    foreach ($issue['covers'] as $cover) {
                        $new_issue->covers()->create($cover);
                    }
                }
            }
        }

        $created_comic_book = ComicBook::whereId($new_comic->id)
                                        ->with('comicIssues')
                                        ->with('covers')
                                        ->with('writers')
                                        ->get();

        // Success response
        Log::info("Successfully created new comic book instance", ['comic_book' => $created_comic_book]);
        return response()->json([
            'data'      => $created_comic_book,
            'message'   => 'Successfully created new comic book'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComicBookRequest $request
     * @param  integer  $comic_book_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComicBookRequest $request, $comic_book_id)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // No matching comic book
        if (!ComicBook::whereId($comic_book_id)->exists()) {
            Log::error("Could not find matching comic book", ['comic_book_id' => $comic_book_id]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find comic book matching ID {$comic_book_id}"
            ], 404);
        }

        $comic_book_data = $request->validated();
        $comic_book = ComicBook::whereId($comic_book_id)
                                ->with('comicIssues')
                                ->with('covers')
                                ->with('writers')
                                ->first();
                                
        $comic_book->update([
            'title'         => $comic_book_data['title'],
            'description'   => $comic_book_data['description'],
            'release_date'  => $comic_book_data['release_date'],
        ]);
        
        // Attach writers against comic book
        if ($comic_book_data['writers']) {
            foreach ($comic_book_data['writers'] as $writer) {
                $comic_book->writers()->sync($writer['id']);
            }
        }

        // Update or create comic book with new issues
        if ($comic_book_data['comic_issues']) {
            foreach ($comic_book_data['comic_issues'] as $issue ) {
                if (!array_key_exists('id', $issue)) $issue['id'] = null;
                $comic_book->comicIssues()->updateOrCreate(
                    ['id' => $issue['id']],
                    [
                        'title'         => $issue['title'],
                        'description'   => $issue['description'],
                        'issue_number'  => $issue['issue_number'],
                        'volume_number' => $issue['volume_number'],
                        'release_date'  => $issue['release_date'],
                    ]
                );
            }
        }

        // Success response
        Log::info("Successfully updated comic book", ['comic_book' => $comic_book]);
        return response()->json([
            'data'      => $comic_book,
            'message'   => 'Succesfully updated comic book'
        ]);
    }

    /**
     * Remove the specified comic book from the DB.
     *
     * @param integer  $comic_book_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comic_book_id)
    {
        // No comic book found
        if (!ComicBook::whereId($comic_book_id)->exists()) {
            Log::error("No comic book found for deletion", ['comic_book_id' => $comic_book_id]);
            return response()->json([
                'data'      => null,
                'message'   => "No comic book found matching ID {$comic_book_id}"
            ], 404);
        }

        $comic = ComicBook::find($comic_book_id);
        $comic->delete();

        // Success response
        Log::info("Successfully deleted comic book", ['comic_book_id' => $comic_book_id]);
        return response()->json([
            'data' => null,
            'message' => 'Successfully deleted comic book'
        ]);
    }
}
