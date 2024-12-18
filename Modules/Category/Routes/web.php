<?php
use Modules\Category\Http\Controllers\CategoryController;

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

Route::prefix('category', 'auth')->group(function() {
    Route::get('/', 'CategoryController@index')->name('category');
    Route::get('/create', [CategoryController::class, 'createForm' ] )->name('category.createForm');
    Route::post('/create', [CategoryController::class, 'create' ] )->name('category.create');
    Route::post('/edit/{id}', [CategoryController::class, 'edit' ] )->name('category.edit');
    Route::post('/del/{id}', [CategoryController::class, 'destroy' ] )->name('category.del');
});
