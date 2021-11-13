<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Support\Facades\Log;

class SkillsController extends Controller
{
    /**
     * Retrieve all skill instances
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::all();

        // No skills found
        if (count($skills) == 0) {
            Log::warning("Could not fetch any skills as the table is empty", ['skills' => []]);
            return response()->json([
                'data'      => [],
                'message'   => "Could not fetch any skills as the table is empty"
            ], 404);
        }

        // Success response
        Log::info("Successfully retrieved all skills");
        return response()->json([
            'data' => SkillResource::collection($skills),
            'message' => 'Successfully fetched all characters'
        ]);
    }

    /**
     * Show specific skill instance
     *
     * @param string $key
     * @return \Illuminate\Http\Response
     */
    public function show($key) 
    {
        if (!Skill::where('key', $key)->exists()) {
            // Invalid datatype
            if (!ctype_alpha($key)) {
                Log::error("Search parameter must be string", ['type' => null]);
                return response()->json([
                    'data'      => null,
                    'message'   => "The key parameter should be of type string"
                ], 400);
            }

            // No matching skill
            Log::warning("Could not find matching skill", ['skill' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find skill matching key {$key}"
            ], 404);
        }
        
        // Success response
        $skill = Skill::where('key', $key)->first();
        Log::info("Successfully retrieved skill", ['skill' => $skill]);
        return response()->json([
            'data'      => $skill,
            'message'   => "Successfully fetched matching skill"
        ]);
    }
}
