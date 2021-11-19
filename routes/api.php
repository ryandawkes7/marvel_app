<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\CharacterTraitsPivotController;
use App\Http\Controllers\CharacterTypesController;
use App\Http\Controllers\ComicBooksController;
use App\Http\Controllers\ComicsController;
use App\Http\Controllers\ComicWritersController;
use App\Http\Controllers\DirectorsController;
use App\Http\Controllers\McuPhaseController;
use App\Http\Controllers\MoviePostersController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SagasController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\TraitsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('characters', CharactersController::class);
Route::apiResource('character-types', CharacterTypesController::class);

Route::apiResource('traits', TraitsController::class);

// TODO: Is this necessary?
Route::apiResource('character-traits', CharacterTraitsPivotController::class);

Route::apiResource('skills', SkillsController::class);

Route::apiResource('movies', MoviesController::class);
Route::apiResource('directors', DirectorsController::class);
Route::apiResource('posters', MoviePostersController::class);

Route::apiResource('phases', McuPhaseController::class);
Route::apiResource('sagas', SagasController::class);

Route::prefix('comics')->group(function () {
    Route::get('/', [ComicBooksController::class, 'index']);
    Route::get('/{id}', [ComicBooksController::class, 'show']);
    Route::post('/', [ComicBooksController::class, 'store']);
    Route::put('/{id}', [ComicBooksController::class, 'update']);
    Route::delete('/{id}', [ComicBooksController::class, 'destroy']);

    Route::prefix('/{comic_id}/issues')->group(function() {
        Route::get('/', [ComicsController::class, 'index']);
        Route::get('/{issue_id}', [ComicsController::class, 'show']);
        Route::post('/', [ComicsController::class, 'store']);
        Route::put('/{issue_id}', [ComicsController::class, 'update']);
        Route::delete('/{issue_id}', [ComicsController::class, 'destroy']);
    });
});

Route::apiResource('/actors', ActorsController::class);

Route::apiResource('comic-writers', ComicWritersController::class);