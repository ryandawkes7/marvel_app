<?php

use App\Http\Controllers\CharactersController;
use App\Http\Controllers\MoviesController;
use Illuminate\Foundation\Application;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {

    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /**
     * Characters Page
     */
    Route::get('/characters', [CharactersController::class, 'main_page'])->name('characters');

    /**
     * Specific Character
     */
    Route::get('/characters/{id}', [CharactersController::class, 'show_page'])->name('character');

    /**
     * Movies Page
     */
    Route::get('/movies', [MoviesController::class, 'main_page'])->name('movies');

    /**
     * Specific Movie
     */
    Route::get('/movies/{id}', [MoviesController::class, 'show_page'])->name('movie');

    
});