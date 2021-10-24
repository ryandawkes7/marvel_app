<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComicBookRequest;
use App\Models\Comic;
use App\Models\ComicBook;
use App\Models\ComicCover;
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

        return response()->json([
            'data' => $comics,
            'message' => 'Successfully fetched all comics'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created comic book in storage.
     *
     * @param  \App\Http\Requests\StoreComicBookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComicBookRequest $request)
    {
        $requested_comic = $request->validated();
        $new_comic = ComicBook::create($requested_comic);

        // Attach writer instance(s)
        if ($request->writers) {
            foreach ($request->writers as $writer) {
                $new_comic->writers()->attach($writer['id']);
            }
        }

        // Create comic issue instance(s) against this comic book
        if ($request->comic_issues) {
            foreach ($request->comic_issues as $issue) {
                $comic = new Comic();
                $comic->comic_book_id   = $new_comic->id;
                $comic->title           = $issue['title'];
                $comic->description     = $issue['description'];
                $comic->issue_number    = $issue['issue_number'];
                $comic->volume_number   = $issue['volume_number'];
                $comic->release_date    = $issue['release_date'];
                $comic->save();

                // Attach character instance(s) to this issue
                foreach ($issue['characters'] as $character) {
                    $comic->characters()->attach($character['id']);
                }

                // Create cover instance(s) against this issue
                foreach ($issue['covers'] as $cover) {
                    $comic_cover = new ComicCover();
                    $comic_cover->comic_id        = $comic->id;
                    $comic_cover->cover_url       = $cover['cover_url'];
                    $comic_cover->is_variant      = $cover['is_variant'];
                    $comic_cover->variant_issue   = $cover['variant_issue'];
                    $comic_cover->save();
                }
            }
        }

        return response()->json([
            'data'      => $new_comic,
            'message'   => 'Successfully created new comic'
        ]);
    }

    /**
     * Show a specific comic
     * 
     * @param integer $comic_id to lookup
     * @return JSON
     */
    public function show($comic_id)
    {
        $movie = ComicBook::whereId($comic_id)
            ->with('writers')
            ->with('comicIssues')
            ->with('covers')
            ->first()
            ->toArray();

        return response()->json([
            'data'      => $movie,
            'message'   => 'Successfully fetched specified comic'
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComicBook  $comicBook
     * @return \Illuminate\Http\Response
     */
    public function edit(ComicBook $comicBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreComicBookRequest $request
     * @param  integer  $comicBook
     * @return \Illuminate\Http\Response
     */
    public function update(StoreComicBookRequest $request, $comic_book_id)
    {
        $data = $request->all();
        $comic = ComicBook::find($comic_book_id);

        $comic->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'release_date' => $data['release_date'],
        ]);

        $writer_ids = [];

        if ($data['writers']) {
            foreach ($data['writers'] as $writer) {
                $writer_ids[] = $writer['id'];
            }
        }

        if (array_key_exists('comic_issues', $data)) {
            foreach ($data['comic_issues'] as $issue) {
                $comic->comicIssues()->create([
                    'title'         => $issue['title'],
                    'description'   => $issue['description'],
                    'issue_number'  => $issue['issue_number'],
                    'volume_number' => $issue['volume_number'],
                    'release_date'  => $issue['release_date'],
                ]);
            }
        }

        $comic->writers()->sync($writer_ids);

        Log::info("Successfully updated comic book", ['comic_book' => $comic]);
        return response()->json([
            'data'      => $comic,
            'message'   => 'Succesfully update comic book'
        ]);
    }

    /**
     * Remove the specified comic book from the DB.
     *
     * @param integer  $comicBook
     * @return \Illuminate\Http\Response
     */
    public function destroy($comic_book_id)
    {
        $comic = ComicBook::find($comic_book_id);

        if (!$comic) {
            return response()->json([
                'data' => null,
                'message' => 'Comic not found'
            ]);
        }
        $comic->delete();
        return response()->json([
            'data' => null,
            'message' => 'Successfully deleted comic'
        ]);
    }
}
