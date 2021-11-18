<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActorRequest;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ActorsController extends Controller
{
    /**
     * Renders index page
     *
     * @return Inertia\Inertia
     */
    public function main_page()
    {
        return Inertia::render('Actors/Index');
    }

    /**
     * Renders show page
     *
     * @return Inertia\Inertia
     */
    public function show_page()
    {
        return Inertia::render('Actors/Show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // No actors found
        if (Actor::count() == 0) {
            Log::warning("No actors could be found in the database", ['actors' => []]);
            return response()->json([
                'data'      => [],
                'message'   => "No actors could be found in the database"
            ], 404);
        }

        // Success response
        Log::info("Successfully fetched all actors", ['actors' => Actor::all()]);
        return response()->json([
            'data'      => Actor::all(),
            'message'   => "Successfully fetched all actors"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(int $actor_id)
    {
        // No actor found
        if (!Actor::whereId($actor_id)->exists()) {
            Log::error("No actor could be found", ['actor_id' => $actor_id]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find actor matching ID {$actor_id}"
            ], 404);
        }

        // Success response
        $actor = Actor::whereId($actor_id)->first();
        Log::info("Successfully fetched actor", ['actor' => $actor]);
        return response()->json([
            'data'      => $actor,
            'message'   => "Successfully fetched actor"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActorRequest $request)
    {
        // Error handling
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $requested_actor = $request->validated();
        $actor = Actor::create($requested_actor);

        Log::info("Successfully created new actor", ['actor' => $actor]);
        return response()->json([
            'data'      => $actor,
            'message'   => "Successully created new actor"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(StoreActorRequest $request, Actor $actor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        //
    }
}
