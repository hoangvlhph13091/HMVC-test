<?php
use Modules\BorrowHistory\Http\Controllers\BorrowHistoryController;

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
    Route::prefix('borrowhistory')->group(function() {
        Route::any('/', [BorrowHistoryController::class, 'index'])->name('borrowhistory');
        Route::get('/create', [BorrowHistoryController::class, 'createForm'])->name('borrowhistory.addForm');
        Route::post('/create', [BorrowHistoryController::class, 'create'])->name('borrowhistory.add');
        Route::get('/view/{id}', [BorrowHistoryController::class, 'view'])->name('borrowhistory.view');
        Route::get('/edit/{id}', [BorrowHistoryController::class, 'editForm'])->name('borrowhistory.editForm');
        Route::post('/edit/{id}', [BorrowHistoryController::class, 'edit'])->name('borrowhistory.edit');
        Route::any('/return/{id}', [BorrowHistoryController::class, 'return'])->name('borrowhistory.return');

        Route::get('/returnBook', [BorrowHistoryController::class, 'returnBookForm'])->name('borrowhistory.returnBookForm');
        Route::post('/returnBook', [BorrowHistoryController::class, 'returnBook'])->name('borrowhistory.returnBook');
        Route::get('/returnBook/getUserInfo', [BorrowHistoryController::class, 'getUserInfo'])->name('borrowhistory.returnBookForm.getUserInfo');


        Route::get('/addRow', [BorrowHistoryController::class, 'AddNewRow'])->name('borrowhistory.addRow');
        Route::GET('/findUser', [BorrowHistoryController::class, 'findUser'])->name('borrowhistory.findUser');
    });
});
