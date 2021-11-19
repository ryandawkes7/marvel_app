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
     * @param  int $actor
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
     * @param  int $actor_id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreActorRequest $request, int $actor_id)
    {
        // Error handling
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // No actor found
        if (!Actor::whereId($actor_id)->exists()) {
            Log::error("Could not find a matching actor to update", ['actor_id' => $actor_id]);
            return response()->json([
                'data'      => null,
                'message'   => "No actor found matching ID {$actor_id}"
            ], 404);
        }

        $requested_actor = $request->validated();
        $updated_actor = Actor::find($actor_id);
        $updated_actor->update($requested_actor);

        // Success response
        Log::info("Successfully updated actor instance", ['actor' => $updated_actor]);
        return response()->json([
            'data'      => $updated_actor,
            'message'   => "Successfully updated actor"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $actor_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $actor_id)
    {
        if (!Actor::whereId($actor_id)->exists()) {
            Log::error("No actor found to delete", ['actor_id' => $actor_id]);
            return response()->json([
                'data'      => null,
                'message'   => "No actor found matching ID {$actor_id}"
            ], 404);
        }

        Actor::find($actor_id)->delete();
        Log::info("Successfully deleted actor instance", ['actor_id' => $actor_id]);
        return response()->json([
            'data'      => null,
            'message'   => "Successfully deleted actor matching ID {$actor_id}"
        ]);
    }
}
