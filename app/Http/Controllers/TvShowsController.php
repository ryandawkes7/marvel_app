<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTvShowRequest;
use App\Models\TvShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TvShowsController extends Controller
{
    /**
     * Returns the index page
     *
     * @return \Inertia\Inertia
     */
    public function main_page()
    {
        return Inertia::render('TvShows/Index.vue');
    }

    /**
     * Returns the show page
     *
     * @return \Inertia\Inertia
     */
    public function show_page()
    {
        return Inertia::render('TvShows/Show.vue');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // No TV Shows in DB
        if (TvShow::count() <= 0) {
            Log::warning("No TV Shows found in database", ['tv_shows' => []]);
            return response()->json([
                'data'      => [],
                'message'   => "No TV Shows found in the database"
            ], 404);
        }

        // Success response
        $shows = TvShow::all();
        Log::info("Successfully fetched all TV Shows", ['tv_shows' => $shows]);
        return response()->json([
            'data'      => $shows,
            'message'   => "Successfully fetched  all TV Shows"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  tv_show_id
     * @return \Illuminate\Http\Response
     */
    public function show(int $tv_show_id)
    {
        // No matching TV Show
        if (!TvShow::whereId($tv_show_id)->exists()) {
            Log::error("Could not find matching TV Show", ['tv_show_id' => $tv_show_id]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find TV Show matching ID {$tv_show_id}"
            ], 404);
        }

        // Success response
        $show = TvShow::find($tv_show_id);
        Log::info("Successfully fetched matching TV Show", ['tv_show' => $show]);
        return response()->json([
            'data'      => $show,
            'message'   => "Successfully found TV Show"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTvShowRequest $request)
    {
        // Error handling
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // Success response
        $requested_tv_show = $request->validated();
        $tv_show = TvShow::create($requested_tv_show);
        Log::info("Successfully cretaed new TV Show instance", ['tv_show' => $tv_show]);
        return response()->json([
            'data'      => $tv_show,
            'message'   => "Successfully created new TV Show"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tv_show_id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTvShowRequest $request, int $tv_show_id)
    {
        // Error response
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // No matching TV Show
        if (!TvShow::whereId($tv_show_id)->exists()) {
            Log::error("Could not find matching TV Show to update", ['tv_show_id' => $tv_show_id]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find TV Show matching ID {$tv_show_id}"
            ], 404);
        }

        // Success response
        $requested_tv_show = $request->validated();
        $tv_show = TvShow::find($tv_show_id);
        $tv_show->update($requested_tv_show);
        Log::info("Successfully updated TV Show", ['tv_show' => $tv_show]);
        return response()->json([
            'data'      => $tv_show,
            'message'   => "Successfully updated TV Show"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tv_show_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $tv_show_id)
    {
        // No matching TV Show
        if (!TvShow::whereId($tv_show_id)->exists()) {
            Log::error("No matching TV Show found for deletion", ['tv_show_id' => $tv_show_id]);
            return response()->json([
                'data'      => null,
                'message'   => "No TV Show found matching ID {$tv_show_id}"
            ], 404);
        }

        // Success response
        TvShow::find($tv_show_id)->delete();
        Log::info("Successfully deleted TV Show instance", ['tv_show_id' => $tv_show_id]);
        return response()->json([
            'data'      => null,
            'message'   => "Successfully deleted TV Show matching ID {$tv_show_id}"
        ]);
    }
}
