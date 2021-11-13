<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComicWriterRequest;
use App\Http\Requests\UpdateComicWriterRequest;
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

        // No writers found in database
        if (count($writers) == 0) {
            Log::error("No writers could be found", ['writers' => null]);
            return response()->json([
                'data' => null,
                'message' => "No comic writers found"
            ], 404);
        }
        
        // Success response
        Log::info("Successfully fetched all writers", ['writers' => $writers]);
        return response()->json([
            'data'      => $writers,
            'message'   => "Successfully fetched all writers"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $writer_id
     * @return \Illuminate\Http\Response
     */
    public function show($writer_id)
    {
        // No matching writer
        if (!ComicWriter::whereId($writer_id)->exists()) {
            Log::error("Could not find comic writer", ['writer_id' => $writer_id]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find writer matching ID {$writer_id}"
            ], 404);
        }

        $writer = ComicWriter::whereId($writer_id)->first();

        // Success response
        Log::info("Successfully retrieved comic writer", ['writer' => $writer]);
        return response()->json([
            'data'      => $writer,
            'message'   => "Successfully retrieved comic writer"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreComicWriterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComicWriterRequest $request)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        $new_writer = ComicWriter::create($request->validated());

        // Success response
        Log::info("Successfully created new comic writer instance", ['comic_writer' => $new_writer]);
        return response()->json([
            'data'      => $new_writer,
            'message'   => 'Successfully created new comic writer'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $writer_id
     * @return \Illuminate\Http\UpdateComicWriterRequest
     */
    public function update(UpdateComicWriterRequest $request, $writer_id)
    {
        // Error handling - invalid data
        if (isset($request->validator) && $request->validator->fails()) {
            Log::info("Invalid data submitted when trying to update comic writer", ['comic_writer' => null]);
            return response()->json([
                'data'      => null,
                'message'   => $request->validator->messages()
            ], 400);
        }

        // No matching comic writer
        if (!ComicWriter::whereId($writer_id)->exists()) {
            Log::error("Could not find matching comic writer", ['comic_writer_id' => $writer_id]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find comic writer matching ID {$writer_id}"
            ], 404);
        }

        $writer_data = $request->validated();
        $comic_writer = ComicWriter::whereId($writer_id)->first();
        $comic_writer->update([
            'name'  => $writer_data['name'],
            'dob'   => $writer_data['dob'],
            'image' => $writer_data['image'],
        ]);

        // Success response
        Log::info("Successfully updated comic writer", ['comic_writer' => $comic_writer]);
        return response()->json([
            'data'      => $comic_writer,
            'message'   => 'Succesfully updated comic book'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($writer_id)
    {
        // No comic book found
        if (!ComicWriter::whereId($writer_id)->exists()) {
            Log::error("No comic writer found for deletion", ['comic_writer_id' => $writer_id]);
            return response()->json([
                'data'      => null,
                'message'   => "No comic writer found matching ID {$writer_id}"
            ], 404);
        }

        $comic_writer = ComicWriter::find($writer_id);
        $comic_writer->delete();

        // Success response
        Log::info("Successfully deleted comic writer", ['comic_writer_id' => $writer_id]);
        return response()->json([
            'data' => null,
            'message' => 'Successfully deleted comic writer'
        ]);
    }
}
