<?php

use App\Http\Controllers\CharactersController;
use App\Http\Controllers\CharacterTraitsPivotController;
use App\Http\Controllers\CharacterTypesController;
use App\Http\Controllers\MoviePostersController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\TraitsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('characters', CharactersController::class);
Route::apiResource('character-types', CharacterTypesController::class);

Route::apiResource('traits', TraitsController::class);
Route::apiResource('character-traits', CharacterTraitsPivotController::class);

Route::apiResource('skills', SkillsController::class);

Route::apiResource('movies', MoviesController::class);
Route::apiResource('posters', MoviePostersController::class);