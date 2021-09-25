<?php

namespace App\Http\Controllers;

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
        $comics = ComicBook::with('characters')
                            ->with('writers')
                            ->with('characters')
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            ->with('characters')
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
