<?php
use Modules\Book\Http\Controllers\BookController;

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

Route::middleware('auth')->group(function () {
    Route::prefix('book')->group(function() {
        Route::any('/', [BookController::class, 'index'])->name('book');
        Route::get('/create', [BookController::class, 'createForm'])->name('book.addForm');
        Route::post('/create', [BookController::class, 'create'])->name('book.add');
        Route::get('/edit/{id}', [BookController::class, 'editForm'])->name('book.editForm');
        Route::any('/delete/{id}', [BookController::class, 'destroy'])->name('book.del');
    });
});
