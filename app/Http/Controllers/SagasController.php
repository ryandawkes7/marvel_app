<?php

namespace App\Http\Controllers;

use App\Models\MovieSaga;
use Illuminate\Support\Facades\Log;

class SagasController extends Controller
{
    public function index()
    {
        $sagas = MovieSaga::all();

        // Error handling
        if (count($sagas) <= 0) {
            Log::warning("No sagas could be found in database", ["sagas" => null]);
            return response()->json([
                'data' => null,
                'message' => "No sagas could be found"
            ], 404);
        }

        // Success response
        return response()->json([
            'data'      => $sagas,
            'message'   => 'Successfully fetched all sagas'
        ]);
    }
}
