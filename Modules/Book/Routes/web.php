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
        Route::post('/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
        Route::any('/delete/{id}', [BookController::class, 'destroy'])->name('book.del');

        Route::get('/create-receipt', [BookController::class, 'createReceiptForm'])->name('book.receipt.addForm');
        Route::post('/create-receipt', [BookController::class, 'createReceipt'])->name('book.receipt.add');
        Route::get('/search-book', [BookController::class, 'searchBook'])->name('book.search_book');
        Route::get('/edit-receipt/{id}', [BookController::class, 'editReceiptForm'])->name('book.receipt.editForm');
        Route::post('/edit-receipt/{id}', [BookController::class, 'editReceipt'])->name('book.receipt.edit');


    });
});
