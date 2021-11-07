<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTraitRequest;
use App\Http\Requests\UpdateTraitRequest;
use App\Http\Resources\TraitResource;
use App\Models\CharTrait;
use Illuminate\Support\Facades\Log;

class TraitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traits = CharTrait::all();

        // No traits found
        if (count($traits) == 0) {
            Log::warning("No traits could be found in the database", ['traits' => []]);
            return response()->json([
                'data' => [],
                'message' => "Could not find any traits in the database"
            ], 404);
        }

        // Success response
        Log::info("Successfully fetched all traits from the database");
        return response()->json([
            'data'      => TraitResource::collection($traits),
            'message'   => 'Successfully fetched all traits'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!CharTrait::whereId($id)->exists()) {
            // No matching trait
            Log::warning("No matching trait could be found", ['trait' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "No trait matching ID {$id}"
            ], 404);
        }

        // Successfully fetched trait
        $trait = CharTrait::whereId($id)->first();
        Log::info("Successfully fetched trait", ['trait' => $trait]);
        return response()->json([
            'data'      => $trait,
            'message'   => "Successfully fetched trait"
        ]);
    }

    /**
     * Store a new pivot entry for traits on a character
     *
     * @param  \Illuminate\Http\StoreTraitRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTraitRequest $request)
    {
        // Error handling
        if (isset($request->validator) && $request->validator->fails()) {
            Log::warning("Invalid data supplied when creating new type", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $requested_trait = $request->validated();
        $new_trait = CharTrait::create($requested_trait);

        // Success response
        Log::info("Succesfully created new trait", ['trait' => $new_trait]);
        return response()->json([
            'data'      => $new_trait,
            'message'   => "Successfully created new trait"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateTraitRequest  $request
     * @param  integer  $trait_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTraitRequest $request, $trait_id)
    {
        // No matching type found
        if (!CharTrait::whereId($trait_id)->exists()) {
            Log::warning("Could not find matching trait to update", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "No trait found matching ID {$trait_id}"
            ], 404);
        }

        // Error handling
        if (isset($request->validator) && $request->validator->fails()) {
            Log::warning("Invalid data supplied when updating trait", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $trait = CharTrait::whereId($trait_id)->first();
        $trait->update($request->validated());

        // Success response
        Log::info("Successfully updated trait", ['type' => $trait]);
        return response()->json([
            'data'      => $trait,
            'message'   => "Successfully updated trait"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $trait_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($trait_id)
    {
        if (!CharTrait::whereId($trait_id)->exists()) {
            // No matching trait
            Log::warning("No matching trait found", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find trait matching ID {$trait_id}"
            ], 404);
        }

        $trait = CharTrait::whereId($trait_id)->first();
        $trait->delete();

        // Success response
        Log::info("Successfully deleted character trait", ['trait' => null]);
        return response()->json([
            'data' => null,
            'message' => "Successfully deleted trait"
        ]);
    }
}
