<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Character;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return response()->json([
            'data' => SkillResource::collection($skills),
            'message' => 'Successfully fetched all characters'
        ], 200);
    }

    public function show($id) 
    {
        $character = Character::whereId($id)->with('skills')->first();

        $values = [];
        foreach($character->flatMap->skills as $skill) {
            $values[] = $skill;
        };
        dd($values);
    }

    public function update()
    {
        
    }

    public function destroy($id)
    {

    }
}
