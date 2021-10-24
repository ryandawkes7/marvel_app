<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComicIssueRequest;
use App\Http\Requests\UpdateComicIssueRequest;
use App\Models\Comic;
use App\Models\ComicBook;
use Illuminate\Support\Facades\Log;

class ComicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param integer comic_id of comic series to look-up on
     * @return \Illuminate\Http\Response
     */
    public function index($comic_id)
    {
        $comic_series = ComicBook::find($comic_id);

        // Error handling
        if (!$comic_series) {
            Log::error("Error retrieving comic issues", ['comic_issues' => null]);
            return response()->json([
                'data'      => null,
                'message'   => 'No comic book found with specified ID'
            ], 404);
        }

        $issues = $comic_series->comicIssues;

        Log::info("Fetched all comic issues for comic book ID {$comic_series->id}", ['comic_issues' => $issues]);

        // Success response
        return response()->json([
            'data' => $issues,
            'message' => 'Successfully fetched all issues for specified comic'
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
     * @param  \Illuminate\Http\Requests\StoreComicIssueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComicIssueRequest $request)
    {
        $req = $request->validated();
        $comic_book = ComicBook::whereId($req['comic_book_id'])->first();

        // Error handling for no comic book series found
        if (!$comic_book) {
            Log::error("Failure when creating comic instance", ['comic_issue' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not create issue as the comic book series could not be found"
            ], 404);
        }

        // Create new comic issue instance
        $new_comic = Comic::create($request->validated());

        Log::info("Created new comic issue", ['comic_issue' => $new_comic]);

        // Attach comic cover instances to comic issue
        if ($request->comic_covers) {
            foreach ($request->comic_covers as $cover) {
                $new_cover = $new_comic->covers()->create([
                    'cover_url' => $cover['cover_url'],
                    'is_variant' => $cover['is_variant'],
                    'variant_issue' => $cover['variant_issue']
                ]);
                Log::info("Created new cover", ['issue_cover' => $new_cover]);
            }
        }

        // Success response
        return response()->json([
            'data' => [
                'comic_issue'   => $new_comic,
                'issue_covers'  => $new_cover ?? null
            ],
            'message'   => "Successfully created new comic issue"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $comic_id of issue to find
     * @param  int  $issue_id of issue to find
     * @return \Illuminate\Http\Response
     */
    public function show($comic_id, $issue_id)
    {
        $issue = Comic::find($issue_id);

        // Error handling
        if (!$issue) {
            Log::error("No comic issue found", ['comic_issue' => null]);
            response()->json([
                'data'      => null,
                'message'   => 'No comic issue found with specified ID'
            ], 404);
        }

        Log::info("Successfully retrieved comic issue", ['comic_issue' => $issue]);

        // Success response
        return response()->json([
            'data' => $issue,
            'message' => 'Successfully fetched specified issue'
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
     * @param  \Illuminate\Http\Requests\UpdateComicIssueRequest  $request
     * @param  int  $comic_id
     * @param  int  $issue_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComicIssueRequest $request, $comic_id, $issue_id)
    {
        $req = $request->validated();

        // Find issue
        $issue = Comic::whereId($issue_id)->first();

        // Error handling for no matching comic issue
        if (!$issue) {
            Log::error("No comic issue found", ['comic_issue' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "No comic issues matching ID of {$issue_id}"
            ], 404);
        }

        // Update comic instance
        $issue->update($req);
        Log::info("Updated comic issue", ['comic_issue' => $issue]);

        // Success response
        return response()->json([
            'data' => $issue,
            'message'   => "Successfully updated comic issue - ID {$issue->id}"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $comic_id
     * @param  int  $issue_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comic_id, $issue_id)
    {
        // Find comic issue
        $issue = Comic::whereId($issue_id)->first();

        // Error handling for no matching comic issue
        if (!$issue) {
            Log::error("No comic issue found", ['comic_issue' => null]);
            return response()->json([
                'data'      => null,
                'message'   => "Could not find comic issue matching ID {$issue_id}"
            ], 404);
        }

        // Delete comic 
        $issue->delete();
        Log::info("Successfully deleted comic issue", ['comic_issue_id' => $issue_id]);
        
        // Success response
        return response()->json([
            'data'      => null,
            'message'   => "Successfully deleted comic issue - ID {$issue_id}"
        ]);
    }
}
