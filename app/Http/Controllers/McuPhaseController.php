<?php

namespace App\Http\Controllers;

use App\Models\McuPhase;
use Illuminate\Http\Request;

class McuPhaseController extends Controller
{
    public function index()
    {
        $phases = McuPhase::all();

        return response()->json([
            'data' => $phases,
            'message' => 'Successfully fetched all character types'
        ], 200);
    }

    public function show()
    {

    }
}
