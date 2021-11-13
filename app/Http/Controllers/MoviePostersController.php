<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePosterRequest;
use App\Http\Requests\UpdatePosterRequest;
use App\Models\MoviePoster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MoviePostersController extends Controller
{

    /**
     * Fetches all posters
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posters = MoviePoster::all();

        // Error handling
        if (count($posters) == 0) {
            Log::warning("No movie posters could be found", ["posters" => null]);
            return response()->json([
                'data'      => null,
                'message'   => "No movie posters could be found"
            ], 404);
        }

        // Success response
        Log::info("Successfully returned all movie posters", ["posters" => $posters]);
        return response()->json([
            'data'      => $posters,
            'message'   => "Successfully fetched all movie posters"
        ]);
    }

    /**
     * Fetches a specific poster instance
     * 
     * @param integer $poster_id
     * @return \Illuminate\Http\Response
     */
    public function show($poster_id)
    {
        // Error handling
        if (!MoviePoster::whereId($poster_id)->exists()) {
            Log::error("Failed to find poster with matching ID", ["poster_id" => $poster_id]);
            return response()->json([
                'data'      => null,
                'message'   => "Failed to find movie poster matching ID {$poster_id}"
            ], 404);
        }

        $poster = MoviePoster::whereId($poster_id)->first();

        // Success response
        Log::info("Successfully returned movie poster", ["poster" => $poster]);
        return response()->json([
            'data'      => $poster,
            'message'   => "Successfully fetched movie poster"
        ]);
    }

    /**
     * Create new poster instance
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePosterRequest $request)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $poster = MoviePoster::create($request->validated());

        // Success response
        Log::info("Successfully cretaed poster", ["poster" => $poster]);
        return response()->json([
            'data' => $poster,
            'message' => 'Successfully stored poster'
        ]);
    }

    public function update(UpdatePosterRequest $request, $poster_id)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // Error handling - no matching poster
        if (!MoviePoster::whereId($poster_id)->exists()) {
            Log::error("No movie poster found", ["poster_id" => $poster_id]);
            return response()->json([
                'data' => null,
                'message' => "Could not find movie poster matching ID {$poster_id}"
            ], 404);
        }

        $data = $request->validated();
        $poster = MoviePoster::whereId($poster_id)->first();
        $poster->update($data);

        // Success resopnse
        Log::info("Successfully updated poster", ["poster" => $poster]);
        return response()->json([
            'data'      => $poster,
            'message'   => "Successfully updated movie poster"
        ]);
    }

    /**
     * Delete an instance of the poster model
     *
     * @param Request $request
     * @return JSON
     */
    public function destroy($id)
    {
        $poster = MoviePoster::find($id);
        $poster->delete();

        return response()->json([
            'message' => 'Successfully removed poster'
        ]);
    }
}
