<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Models\Character;
use Inertia\Inertia;

class CharactersController extends Controller
{  
    public function index()
    {
        return Inertia::render('Characters/Index');
    }

    /**
     * Fetch all characters
     */
    public function fetch()
    {
        $characters = Character::all();
    }

    /**
     * Creates a new character
     * @authenticated
     * 
     * @bodyParam 
     */
    public function store(StoreCharacterRequest $request)
    {
        $requested_character = $request->validated();
        $new_character = Character::create($requested_character);

        return response()->json([
            'data' => new Character($new_character),
            'message' => 'Successfully created character'
        ]);
    }
}
