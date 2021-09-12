<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use Inertia\Inertia;
use App\Models\Movie;
use App\Models\MoviePoster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $movies = Movie::with('sagas')
                        ->with('posters')
                        ->with('phase')
                        ->with('directors')
                        ->get();
                        
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
        $movie = Movie::whereId($id)
                        ->with('sagas')
                        ->with('posters')
                        ->with('phase')
                        ->with('directors')
                        ->first()->toArray();

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
    public function store(StoreMovieRequest $request)
    {
        $requested_movie = $request->validated();
        $new_movie = Movie::create($requested_movie);

        // Attach saga instance(s)
        if ($request->sagas) {
            foreach ($request->sagas as $saga) {
                $new_movie->sagas()->attach($saga['id']);
            }
        }

        // Attach poster instance(s)
        if ($request->posters) {
            foreach ($request->posters as $poster) {
                $val = strval($poster);
                
                $poster = new MoviePoster();
                $poster->movie_id = 1;
                $poster->image_url = $val;
                $poster->user_id = Auth::id();
                $poster->save();
            }
        }

        // Attach director instance(s)
        if ($request->directors) {
            foreach ($request->directors as $director) {
                $new_movie->directors()->attach($director['id']);
            }
        }

        // Attach character instances
        if ($request->characters) {

        }

        return response()->json([
            'data'      => $new_movie,
            'message'   => 'Successfully created new movie'
        ]);
    }

    public function update(Request $request, $movie_id)
    {
        $data = $request->all();
        $movie = Movie::whereId($movie_id)->first();

        $movie->update([
            'title'         => $data['title'],
            'release_date'  => $data['release_date'],
            'in_mcu'        => $data['in_mcu'],
            'mcu_phase_id'  => $data['mcu_phase_id'],
        ]);

        $saga_ids = [];
        $director_ids = [];

        foreach ($data['sagas'] as $saga) {
            $saga_ids[] = $saga['id'];
        }

        foreach ($data['directors'] as $director) {
            $director_ids[] = $director['id'];
        }

        $movie->sagas()->sync($saga_ids);
        $movie->directors()->sync($director_ids);

        return response()->json([
            'data'      => $movie,
            'message'   => 'Succesfully update movie'
        ]);
    }

}
