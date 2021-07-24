<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterTraitsPivotController extends Controller
{
    //

    /**
     * Retrieve all pivot entries on a specific character
     *
     * @return void
     */
    public function show($char_id) {

        // Retrieve character
        // Find and return all CharacterTrait pivot entries (as array)

        $char = Character::whereId($char_id)->first();

        $pivot_arr = [];
        foreach($char->traits as $trait) {
            $pivot_arr[] = $trait;
        }
        
        return response()->json([
            'data'      => $pivot_arr,
            'message'   => 'Successfully retrieved all traits for this character'
        ], 200);
    }
}
