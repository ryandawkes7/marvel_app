<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComicBookRequest;
use App\Models\ComicBook;
use Illuminate\Http\Request;
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

        // Attach comic issue instance(s)
        if ($request->comic_issues) {
            foreach ($request->comic_issues as $issue) {
                $new_comic->comicIssues()->attach($issue['id']);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComicBook  $comicBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComicBook $comicBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComicBook  $comicBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComicBook $comicBook)
    {
        //
    }
}
