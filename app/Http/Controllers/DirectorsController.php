<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorsController extends Controller
{
    /**
     * Fetches all directors
     *
     * @return JSON
     */
    public function index()
    {        
        $directors = Director::all();
        return response()->json([
            'data' => $directors,
            'message' => 'Successfully fetched all characters'
        ], 200);
    }

    /**
     * Fetch a specific director
     * 
     * @return JSON
     */
    public function show($director_id)
    {
        $director = Director::whereId($director_id)->first()->toArray();

        return response()->json([
            'data'      => $director,
            'message'   => 'Successfully fetched specified character'
        ], 200);
    }
}
