<?php

namespace App\Http\Controllers;

use App\Models\MovieSaga;
use Illuminate\Http\Request;

class SagasController extends Controller
{
    public function index()
    {
        $sagas = MovieSaga::all();

        return response()->json([
            'data'      => $sagas,
            'message'   => 'Successfully fetched all sagas'
        ]);
    }
}
