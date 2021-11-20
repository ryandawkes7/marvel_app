<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\ComicBooksController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvShowsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {

    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /**
     * Characters
     */
    Route::prefix('/characters')->group(function () {
        Route::get('/', [CharactersController::class, 'main_page'])->name('characters');
        Route::get('/{id}', [CharactersController::class, 'show_page'])->name('characters.show');
    });  

    /**
     * Movies
     */
    Route::prefix('/movies')->group(function () {
        Route::get('/', [MoviesController::class, 'main_page'])->name('movies');
        Route::get('/{id}', [MoviesController::class, 'show_page'])->name('movies.show');
    });

    /**
     * Comics
     */
    Route::prefix('/comics')->group(function () {
        Route::get('/', [ComicBooksController::class, 'main_page'])->name('comics');
        Route::get('/{id}', [ComicBooksController::class, 'show_page'])->name('comics.show');
    });

    /**
     * Actor
     */
    Route::prefix('/actors')->group(function () {
        Route::get('/', [ActorsController::class, 'main_page'])->name('actors');
        Route::get('/{id}', [ActorsController::class, 'show_page'])->name('actors.show');
    });

    /**
     * TV Shows
     */
    Route::prefix('/tv-shows')->group(function () {
        Route::get('/', [TvShowsController::class, 'main_page'])->name('tv_shows');
        Route::get('/{id}', [TvShowsController::class, 'show_page'])->name('tv_shows.show');
    });
});