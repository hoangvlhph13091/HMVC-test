<?php

use Illuminate\Http\Request;
use Modules\Post\Http\Controllers\PostController;


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

Route::middleware('api')->group(function () {
    Route::prefix('post')->group(function () {
        Route::post('/show', [PostController::class, 'show' ] )->name('show');
    });
});
