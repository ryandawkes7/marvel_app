<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use App\Models\Skill;
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
    public function show_page($character_id)
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
        return response()->json([
            'data' => CharacterResource::collection($characters),
            'message' => 'Successfully fetched all characters'
        ], 200);
    }

    /**
     * Creates a new character
     * 
     * @group Characters
     * @authenticated
     * 
     * @response 200 {
     *   "data": {
     *     "alias": "Iron Man",
     *     "real_name": "Tony Stark",
     *     "sex": "male",
     *     "thumb_url": "a",
     *     "morality": "hero",
     *     "type_id": "1",
     *     "updated_at": "2021-06-05T14:48:05.000000Z",
     *     "created_at": "2021-06-05T14:48:05.000000Z",
     *     "id": 2
     *   },
     *   "message": "Successfully created character"
     * }
     */
    public function store(StoreCharacterRequest $request)
    {
        $requested_character = $request->validated();
        $new_character = Character::create($requested_character);
        $skills = Skill::all();
        foreach($skills as $skill) {
            $new_character->skills()->attach($skill->id);
        }

        return response()->json([
            'data' => $new_character,
            'message' => 'Successfully created character'
        ]);
    }

    /**
     * Show a specific character
     */
    public function show($id)
    {
        $character = Character::whereId($id)->with('skills')->first()->toArray();
        return response()->json([
            'data' => $character,
            'message' => 'Successfully fetched specified character'
        ], 200);
    }

    /**
     * Update a specific character
     */
    public function update(StoreCharacterRequest $request, $character_id)
    {
        $character = Character::where('id', $character_id)->first();
        $requested_character = $request->validated();

        if (!$character) {
            return response()->json([
                'data' => null,
                'message' => 'Character not found'
            ]);
        }

        $updated_character = $character->update($requested_character);
        return response()->json([
            'data' => $character,
            'message' => 'Successfully updated character'
        ]);

    }

    /**
     * Delete a specific character
     */
    public function destroy($id)
    {
        $character = Character::where('id', $id)->first();

        if (!$character) {
            return response()->json([
                'data' => null,
                'message' => 'Character not found'
            ]);
        }
        $character->delete();
        return response()->json([
            'data' => null,
            'message' => 'Successfully deleted character'
        ]);

    }
}
