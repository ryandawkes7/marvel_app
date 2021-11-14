<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use App\Http\Traits\EnumTrait;
use App\Models\Skill;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CharactersController extends Controller
{  

    /**
     * Render main page view
     */
    public function main_page()
    {
        return Inertia::render('Characters/Index');
    }

    /**
     * Return a specific character
     */
    public function show_page()
    {
        return Inertia::render('Characters/Show');
    }

    /**
     * Fetch all characters
     * 
     * @group Characters
     */
    public function index()
    {
        $characters = Character::all();
        
        // Error handling
        if (count($characters) == 0) {
            Log::warning("No characters found in database", ['characters' => []]);
            return response()->json([
                'data' => null,
                'message' => 'No characters found in database'
            ], 404);
        }

        // Success response
        Log::info("Successfully fetched all characters", ['characters' => $characters]);
        return response()->json([
            'data' => CharacterResource::collection($characters),
            'message' => 'Successfully fetched all characters'
        ], 200);
    }

    /**
     * Show a specific character
     */
    public function show($id)
    {
        // No character found
        if (!Character::whereId($id)->exists()) {
            Log::error("No matching character found", ['character' => null]);
            return response()->json([
                'data' => null,
                'message' => "No character found matching ID {$id}"
            ], 404);
        }

        $character = Character::whereId($id)
                                ->with('skills')
                                ->with('type')
                                ->with('traits')
                                ->first();

        $morality_options = EnumTrait::fetchValues('characters', 'morality');
        $sex_options = EnumTrait::fetchValues('characters', 'sex');

        // Success response
        Log::info("Successfully fetched character", ['character' => $character]);;
        return response()->json([
            'data' => [
                'character' => $character,
                'morality'  => $morality_options,
                'sex'       => $sex_options,
            ],
            'message' => 'Successfully fetched specified character'
        ]);
    }

    /**
     * Creates a new character
     * 
     * @group Characters
     * @authenticated
     * 
     * @response 200 {
     *  "data": {
     *      "alias": "Iron Man",
     *      "real_name": "Tony Stark",
     *      "sex": "Male",
     *      "thumb_url": "https://logo.com/logo.png",
     *      "morality": "Hero",
     *      "type_id": 1,
     *      "updated_at": "2021-09-12T13:02:45.000000Z",
     *      "created_at": "2021-09-12T13:02:45.000000Z",
     *      "id": 123
     *  },
     *  "message": "Successfully created character"
     * }
     */
    public function store(StoreCharacterRequest $request)
    {
        // Failed validation
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }
        
        // New character instance
        $requested_character = $request->validated();
        $new_character = Character::create($requested_character);

        // Attaches skill instances to character with values
        if ($request->skills) {   
            foreach ($request->skills as $requested_skill) {
                $skill = Skill::where('key', $requested_skill['key'])->first();

                // Skip over non-matching key
                if (!$skill) {
                    Log::warning("Could not find a matching skill key", ['skill_key' => $requested_skill['key']]);
                    continue;
                }

                // Successful attachment
                Log::info("Adding {$skill->name} value to new character", ['skills' => $new_character->skills]);
                $new_character->skills()->attach($skill->id, ['value' => $requested_skill['value']]);
            }
        }

        // Attaches specified trait instances
        if ($request->traits) {
            foreach ($request->traits as $trait) {
                Log::info("Successfully attached trait to new character", ['trait' => $trait]);
                $new_character->traits()->attach($trait['id']);
            }
        }

        // Attaches specified movie istances
        if ($request->movies) {
            foreach ($request->movies as $movie) {
                Log::info("Successfully attached movie to new character", ['movie' => $movie]);
                $new_character->movies()->attach($movie['id']);
            }
        }

        $created_character = Character::whereId($new_character->id)
                                        ->with('skills')
                                        ->with('traits')
                                        ->with('movies')
                                        ->first();

        // Success response
        Log::info("Successfully created new character", ['character' => $created_character]);
        return response()->json([
            'data' => $created_character,
            'message' => 'Successfully created character'
        ]);
    }

    /**
     * Update a specific character
     */
    public function update(UpdateCharacterRequest $request, $character_id)
    {
        // Failed validation
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // No character found
        if (!Character::where('id', $character_id)->exists()) {
            Log::error("Could not find a matching character to update", ['character' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find a matching character"
            ], 404);
        }

        // Update & fetch character instance
        $character_data = $request->validated();
        $character = Character::where('id', $character_id)->first();
        $character->update($character_data);

        // Attach traits against character
        if (array_key_exists('traits', $character_data)) {
            $character->traits()->sync(array_column($character_data['traits'], 'id'));
        }

        // TODO: Support for skills and movies against character

        $updated_character = Character::whereId($character_id)
                                        ->with('skills')
                                        ->with('movies')
                                        ->with('traits')
                                        ->first();
           
        // Success response
        Log::info("Successfuly updated character", ['character' => $updated_character]);
        return response()->json([
            'data' => $updated_character,
            'message' => 'Successfully updated character'
        ]);

    }

    /**
     * Delete a specific character
     */
    public function destroy($id)
    {
        // No matching character
        if (!Character::whereId($id)->exists()) {
            Log::warning("No matching character found", ['character' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find character matching ID {$id}"
            ], 404);
        }

        Character::where('id', $id)->first()->delete();
        
        // Succesful response
        Log::info("Successfully deleted character", ['character' => null]);
        return response()->json([
            'data' => null,
            'message' => 'Successfully deleted character'
        ]);
    }
}
