<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectorRequest;
use App\Http\Requests\UpdateDirectorRequest;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DirectorsController extends Controller
{
    /**
     * Fetches all directors
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $directors = Director::all();

        // No directors found
        if (count($directors) == 0) {
            Log::warning("No directors found in database", ['directors' => []]);
            return response()->json([
                'data'      => [],
                'message'   => "Could not find any directors in the database"
            ], 404);
        }

        // Success response
        Log::info("Successfully fetched all directors", ['directors' => $directors]);
        return response()->json([
            'data' => $directors,
            'message' => 'Successfully fetched all characters'
        ]);
    }

    /**
     * Fetch a specific director
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($director_id)
    {
        // No matching director
        if (!Director::whereId($director_id)->exists()) {
            Log::error("No matching director found", ['director' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find director matching ID {$director_id}"
            ], 404);
        }

        $director = Director::whereId($director_id)->first();

        // Success response
        Log::info("Successfully fetched matching director");
        return response()->json([
            'data'      => $director,
            'message'   => 'Successfully fetched specified character'
        ]);
    }

    /**
     * Creates new director instance
     *
     * @param StoreDirectorRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDirectorRequest $request) 
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // Success response
        $director = Director::create($request->validated());
        Log::info("Successfully created director", ["director" => $director]);
        return response()->json([
            'data' => $director,
            'message' => 'Successfully created director'
        ]);
    }

    /**
     * Updates a director instance
     *
     * @param UpdateDirectorRequest $request
     * @param integer $director_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDirectorRequest $request, $director_id)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // Error handling - no matching director
        if (!Director::whereId($director_id)->exists()) {
            Log::error("No movie director found", ["director_id" => $director_id]);
            return response()->json([
                'data' => null,
                'message' => "Could not find movie director matching ID {$director_id}"
            ], 404);
        }

        $data = $request->validated();
        $director = Director::whereId($director_id)->first();
        $director->update($data);

        // Success resopnse
        Log::info("Successfully updated director", ["director" => $director]);
        return response()->json([
            'data'      => $director,
            'message'   => "Successfully updated movie director"
        ]);
    }

    /**
     * Deletes a specific director instance
     *
     * @param integer $director_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($director_id)
    {
        // No matching director
        if (!Director::whereId($director_id)->exists()) {
            Log::warning("No matching director found to delete", ['director' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "No director found matching ID {$director_id}"
            ], 404);
        }

        $director = Director::find($director_id);
        $director->delete();

        // Success response
        Log::info("Successfully deleted director instance");
        return response()->json([
            'data'      => null,
            'message'   => 'Successfully removed director'
        ]);
    }
}
