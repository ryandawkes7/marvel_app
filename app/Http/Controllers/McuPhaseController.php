<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMcuPhaseRequest;
use App\Http\Requests\UpdateMcuPhaseRequest;
use App\Models\McuPhase;
use Illuminate\Support\Facades\Log;

class McuPhaseController extends Controller
{
    /**
     * Fetches all phases
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $phases = McuPhase::all();

        // No phases found
        if (count($phases) == 0) {
            Log::warning("No phases found in database", ['phases' => []]);
            return response()->json([
                'data'      => [],
                'message'   => "Could not find any phases in the database"
            ], 404);
        }

        // Success response
        Log::info("Successfully fetched all phases", ['phases' => $phases]);
        return response()->json([
            'data' => $phases,
            'message' => 'Successfully fetched all phases'
        ]);
    }

    /**
     * Fetch a specific phase
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($phase_id)
    {
        // No matching phase
        if (!McuPhase::whereId($phase_id)->exists()) {
            Log::error("No matching phase found", ['phase' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find phase matching ID {$phase_id}"
            ], 404);
        }

        $phase = McuPhase::whereId($phase_id)->first();

        // Success response
        Log::info("Successfully fetched matching phase");
        return response()->json([
            'data'      => $phase,
            'message'   => 'Successfully fetched specified phase'
        ]);
    }

    /**
     * Creates new phase instance
     *
     * @param StoreMcuPhaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMcuPhaseRequest $request) 
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // Success response
        $phase = McuPhase::create($request->validated());
        Log::info("Successfully created phase", ["phase" => $phase]);
        return response()->json([
            'data' => $phase,
            'message' => 'Successfully created phase'
        ]);
    }

    /**
     * Updates a phase instance
     *
     * @param UpdateMcuPhaseRequest $request
     * @param integer $phase_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMcuPhaseRequest $request, $phase_id)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // Error handling - no matching phase
        if (!McuPhase::whereId($phase_id)->exists()) {
            Log::error("No movie phase found", ["phase_id" => $phase_id]);
            return response()->json([
                'data' => null,
                'message' => "Could not find movie phase matching ID {$phase_id}"
            ], 404);
        }

        $data = $request->validated();
        $phase = McuPhase::whereId($phase_id)->first();
        $phase->update($data);

        // Success resopnse
        Log::info("Successfully updated phase", ["phase" => $phase]);
        return response()->json([
            'data'      => $phase,
            'message'   => "Successfully updated movie phase"
        ]);
    }

    /**
     * Deletes a specific phase instance
     *
     * @param integer $phase_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($phase_id)
    {
        // No matching phase
        if (!McuPhase::whereId($phase_id)->exists()) {
            Log::warning("No matching phase found to delete", ['phase' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "No phase found matching ID {$phase_id}"
            ], 404);
        }

        $phase = McuPhase::find($phase_id);
        $phase->delete();

        // Success response
        Log::info("Successfully deleted phase instance");
        return response()->json([
            'data'      => null,
            'message'   => 'Successfully removed phase'
        ]);
    }
}
