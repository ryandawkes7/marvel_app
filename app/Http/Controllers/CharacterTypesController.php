<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterTypeResource;
use App\Models\CharacterType;
use Illuminate\Http\Request;

class CharacterTypesController extends Controller
{
    //
    public function index()
    {
        $types = CharacterType::all();

        return response()->json([
            'data' => CharacterTypeResource::collection($types),
            'message' => 'Successfully fetched all character types'
        ], 200);
    }

    public function show($id)
    {
        $type = CharacterType::where('id', $id)->get();
        if (!$type) {
            return response()->json([
                'data' => null,
                'message' => 'No type found for this ID'
            ]);
        }

        return response()->json([
            'data' => CharacterTypeResource::collection($type),
            'message' => 'Successfully fetched character type'
        ]);
    }
}
