<?php

namespace App\Http\Controllers;

use App\Models\ComicWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComicWritersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $writers = ComicWriter::all();

        if (count($writers) == 0) {
            Log::error("No writers could be found", ['writers' => null]);
            return response()->json([
                'data' => null,
                'message' => "No comic writers found"
            ], 400);
        }
        
        Log::info("Successfully fetched all writers", ['writers' => $writers]);
        return response()->json([
            'data'      => $writers,
            'message'   => "Successfully fetched all writers"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $writer_id
     * @return \Illuminate\Http\Response
     */
    public function show($writer_id)
    {
        $writer = ComicWriter::whereId($writer_id)->first();

        if (!$writer->exists()) {
            Log::error("Could not find comic writer", ['writer' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find writer matching ID {$writer_id}"
            ], 404);
        }

        Log::info("Successfully retrieved comic writer", ['writer' => $writer]);
        return response()->json([
            'data'      => $writer,
            'message'   => "Successfully retrieved comic writer"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
