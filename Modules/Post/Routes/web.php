<?php
use Modules\Post\Http\Controllers\PostController;
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

Route::prefix('post')->group(function() {
    Route::get('/', 'PostController@index')->name('post');
    Route::get('/create', [PostController::class, 'createForm' ] )->name('createForm');
    Route::post('/create', [PostController::class, 'create' ] )->name('create');
});
