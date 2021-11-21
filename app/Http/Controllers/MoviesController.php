<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Director;
use Inertia\Inertia;
use App\Models\Movie;
use App\Models\MovieSaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::get();

            // Error handling
        if (count($movies) == 0) {
            Log::error("No movies could be found", ["movies" => null]);
            return response()->json([
                'data'      => null,
                'message' => "No movies found"
            ], 404);
        }

        // Success response
        Log::info("Successfully fetched all movies", ["movies" => $movies]);
        return response()->json([
            'data' => $movies,
            'message' => 'Successfully fetched all characters'
        ], 200);
    }


    /**
     * Show a specific movie
     * 
     * @param $movie_id
     * @return JSON
     */
    public function show($movie_id)
    {
        // Error handling
        if (!Movie::whereId($movie_id)->exists()) {
            Log::error("Could not find the movie from the ID provided", ["movie_id" => $movie_id]);
            return response()->json([
                'data' => null,
                'message' => "Could not find a movie matching ID {$movie_id}"
            ], 404);
        }
        
        $movie = Movie::whereId($movie_id)->first()->toArray();

        // Success response
        Log::info("Successfully fetched specified movie", ["movie" => $movie]);
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
        // Error handling
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $requested_movie = $request->validated();
        $new_movie = Movie::create($requested_movie);

        // Attach saga instance(s)
        if ($request->sagas) {
            foreach ($request->sagas as $saga) {
                // Error handling
                if (!MovieSaga::where('id', $saga['id'])->exists()) {
                    Log::error("Could not find specified saga", ['saga_id' => $saga['id']]);
                    return response()->json([
                        'data' => null,
                        'message' => "Could not find saga matching ID {$saga['id']}"
                    ], 404);
                }
                $new_movie->sagas()->attach($saga['id']);
            }
        }


        // Create poster instance(s)
        if ($request->posters) {
            foreach ($request->posters as $poster) {
                $new_movie->posters()->create([
                    'image_url' => strval($poster),
                    'user_id'   => Auth::id()
                ]);
            }
        }

        // Attach director instance(s)
        if ($request->directors) {
            foreach ($request->directors as $director) {
                // Error handling
                if (!Director::where('id', $director['id'])->exists()) {
                    Log::error("Could not find specified director", ['director_id' => $director['id']]);
                    return response()->json([
                        'data' => null,
                        'message' => "Could not find director matching ID {$director['id']}"
                    ], 404);
                }
                $new_movie->directors()->attach($director['id']);
            }
        }

        // Attach character instances
        // TODO Testing for characters in MovieTest
        if ($request->characters) {
            foreach ($request->characters as $character) {
                $new_movie->characters()->attach($character['id']);
            }
        }

        return response()->json([
            'data'      => $new_movie,
            'message'   => 'Successfully created new movie'
        ]);
    }

    public function update(StoreMovieRequest $request, $movie_id)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $movie_data = $request->validated();

        // Error handling
        if (!Movie::whereId($movie_id)->exists()) {
            Log::error("Could not find a matching movie to update", ['movie_id' => $movie_id]);
            return response()->json([
                'data' => null,
                'message' => "Could not find movie matching ID {$movie_id}"
            ], 404);
        }

        $movie = Movie::whereId($movie_id)->first();

        $movie->update([
            'title'         => $movie_data['title'],
            'release_date'  => $movie_data['release_date'],
            'in_mcu'        => $movie_data['in_mcu'],
            'mcu_phase_id'  => $movie_data['mcu_phase_id'],
        ]);

        $saga_ids = [];
        $director_ids = [];

        // Sync sagas against movie
        if (array_key_exists('sagas', $movie_data)) {
            foreach ($movie_data['sagas'] as $saga) {
                // Error handling
                if (!MovieSaga::where('id', $saga['id'])->exists()) {
                    Log::error("Could not find specified saga", ['saga_id' => $saga['id']]);
                    return response()->json([
                        'data' => null,
                        'message' => "Could not find saga matching ID {$saga['id']}"
                    ], 404);
                }
            }

            $movie->sagas()->sync(array_column($movie_data['sagas'], 'id'));
        }

        // Sync directors against movie
        if (array_key_exists('directors', $movie_data)) {
            foreach ($movie_data['directors'] as $director) {
                // Error handling
                if (!Director::where('id', $director['id'])->exists()) {
                    Log::error("Could not find specified director", ['director_id' => $director['id']]);
                    return response()->json([
                        'data' => null,
                        'message' => "Could not find director matching ID {$director['id']}"
                    ], 404);
                }
            }

            $movie->directors()->sync(array_column($movie_data['directors'], 'id'));
        }

        // TODO Ability to update movie with new posters

        // Success response
        Log::info("Successfully updated movie instance", ["movie" => $movie]);
        return response()->json([
            'data'      => $movie,
            'message'   => 'Succesfully updated movie'
        ]);
    }

    public function destroy(Request $request, $movie_id)
    {
        $movie = Movie::whereId($movie_id)->first();

        // Error handling
        if (!$movie) {
            Log::error("Could not find movie to delete", ["movie_id" => $movie_id]);
            return response()->json([
                'data' => null,
                'message' => "Could not find movie with ID {$movie_id}"
            ], 404);
        }

        // Delete movie
        $movie->delete();

        // Success response
        Log::info("Successfully deleted movie instance", ["movie_id" => $movie_id]);
        return response()->json([
            'data'      => null,
            'message'   => 'Successfully deleted movie instance'
        ]);
    }
}
