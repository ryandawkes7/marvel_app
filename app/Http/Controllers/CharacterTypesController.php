<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterTypeRequest;
use App\Http\Requests\UpdateCharacterTypeRequest;
use App\Http\Resources\CharacterTypeResource;
use App\Models\CharacterType;
use Illuminate\Support\Facades\Log;

class CharacterTypesController extends Controller
{
    /**
     * Fetch all Character Types
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = CharacterType::all();

        // Error handling
        if (count($types) == 0) {
            Log::warning("No character types exists in the database", ['types' => []]);
            return response()->json([
                'data'      => [],
                'message'   => "Could not find any character types in the database"
            ], 404);
        }

        // Success response
        Log::info("Succesfully fetched all character types", ['types' => $types]);
        return response()->json([
            'data' => CharacterTypeResource::collection($types),
            'message' => 'Successfully fetched all character types'
        ], 200);
    }

    /**
     * Fetch a specific type by its key
     *
     * @param string $key
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        if (!CharacterType::where('key', $key)->exists()) {
            // Invalid datatype
            if (!ctype_alpha($key)) {
                Log::error("Search parameter must be string", ['type' => null]);
                return response()->json([
                    'data'      => null,
                    'message'   => "The key parameter should be of type string"
                ], 400);
            }

            // No matching type
            Log::warning("No matching type could be found", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "No type matching the key {$key}"
            ], 404);
        }

        // Successfully fetched type
        $type = CharacterType::where('key', $key)->first();
        Log::info("Successfully fetched character type", ['type' => $type]);
        return response()->json([
            'data'      => $type,
            'message'   => "Successfully fetched character type"
        ]);
    }

    /**
     * Creates a new character type instance
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCharacterTypeRequest $request)
    {
        // Error handling
        if (isset($request->validator) && $request->validator->fails()) {
            Log::warning("Invalid data supplied when creating new type", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $requested_type = $request->validated();
        $new_type = CharacterType::create($requested_type);

        // Success response
        Log::info("Succesfully created new character type", ['type' => $new_type]);
        return response()->json([
            'data'      => $new_type,
            'message'   => "Successfully created new type"
        ]);
    }

    public function update(UpdateCharacterTypeRequest $request, $key)
    {
        // Error handling
        if (isset($request->validator) && $request->validator->fails()) {
            Log::warning("Invalid data supplied when creating new type", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        if (!CharacterType::where('key', $key)->exists()) {
            // Invalid datatype
            if (!ctype_alpha($key)) {
                Log::error("Search parameter must be string", ['type' => null]);
                return response()->json([
                    'data'      => null,
                    'message'   => "The key parameter should be of type string"
                ], 400);
            }

            // No matching type found
            Log::warning("Could not find matching type to update", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "No charatcer type found matching key {$key}"
            ], 404);
        }

        $type = CharacterType::where('key', $key)->first();
        $type->update(['type' => $request->validated()['type']]);

        $updated_type = CharacterType::where('key', $key)->first();

        // Success response
        Log::info("Successfully updated character type", ['type' => $updated_type]);
        return response()->json([
            'data'      => $type,
            'message'   => "Successfully updated character type"
        ]);
    }

    public function destroy($key)
    {
        if (!CharacterType::where('key', $key)->exists()) {
            // Invalid datatype
            if (!ctype_alpha($key)) {
                Log::error("Search parameter must be string", ['type' => null]);
                return response()->json([
                    'data'      => null,
                    'message'   => "The key parameter should be of type string"
                ], 400);
            }

            // No matching type
            Log::warning("No matching type found", ['type' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find type matching key {$key}"
            ], 404);
        }

        $type = CharacterType::where('key', $key)->first();
        $type->delete();

        // Success response
        Log::info("Successfully deleted character type", ['type' => null]);
        return response()->json([
            'data' => null,
            'message' => "Successfully deleted character type"
        ]);
    }
}
