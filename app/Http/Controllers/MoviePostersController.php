<?php

namespace App\Http\Controllers;

use App\Models\MoviePoster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class MoviePostersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image'     => 'required|string|url|unique:movie_posters,image_url',
            'movie_id'  => 'required|integer'
        ]);

        $poster             = new MoviePoster();
        $poster->movie_id   = $request['movie_id'];
        $poster->image_url  = $request['image'];
        $poster->user_id    = Auth::id();
        $poster->created_at = Date::now();
        $poster->updated_at = Date::now();
        $poster->save();

        return response()->json([
            'data' => $poster,
            'message' => 'Successfully stored poster'
        ]);
    }
}
