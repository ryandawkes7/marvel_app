<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use Inertia\Inertia;
use App\Models\Movie;

class MoviesController extends Controller
{
    /**
     * Render main page view
     */
    public function main_page()
    {
        return Inertia::render('Movies/Index');
    }

    /**
     * Return a specific character
     */
    public function show_page()
    {
        return Inertia::render('Movies/Show');
    }

    /**
     * Fetch all movies
     *
     * @return JSON
     */
    public function index()
    {        
        $movies = Movie::all();
        return response()->json([
            'data' => $movies,
            'message' => 'Successfully fetched all characters'
        ], 200);
    }


    /**
     * Show a specific movie
     * 
     * @return JSON
     */
    public function show($id)
    {
        $movie = Movie::whereId($id)->with('sagas')->with('posters')->first()->toArray();
        return response()->json([
            'data'      => $movie,
            'message'   => 'Successfully fetched specified character'
        ], 200);
    }

    /**
     * Create a new movie
     *
     * @param StoreMovieRequest $request
     * @param Integer $saga_id
     * @return JSON
     */
    public function store(StoreMovieRequest $request, $saga_id)
    {
        $requested_movie = $request->validated();
        $new_movie = Movie::create($requested_movie);

        if ($saga_id) $new_movie->sagas()->attach($saga_id);

        return response()->json([
            'data'      => $new_movie,
            'message'   => 'Successfully created new movie'
        ]);
    }

}
