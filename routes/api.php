<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'movie'], function () {
    Route::post('create', [MovieController::class, 'create']);
    Route::put('{id}/edit', [MovieController::class, 'edit']);
    Route::delete('{id}/delete', [MovieController::class, 'delete']);
    Route::get('{id}', [MovieController::class, 'show']);
    Route::get('all', [MovieController::class, 'index']);
    Route::put('{id}/change-status', [MovieController::class, 'changeMovieStatus']);
});

Route::group(['prefix' => 'genre'], function () {
    Route::post('create', [GenreController::class, 'create']);
    Route::put('{id}/edit', [GenreController::class, 'edit']);
    Route::delete('{id}/delete', [GenreController::class, 'delete']);
    Route::get('{id}', [GenreController::class, 'show']);
    Route::get('all', [GenreController::class, 'index']);
});
