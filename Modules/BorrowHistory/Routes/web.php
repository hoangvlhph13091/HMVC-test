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
        Route::any('/return/{id}', [BorrowHistoryController::class, 'return'])->name('borrowhistory.return');

        Route::get('/addRow', [BorrowHistoryController::class, 'AddNewRow'])->name('borrowhistory.addRow');
        Route::GET('/findUser', [BorrowHistoryController::class, 'findUser'])->name('borrowhistory.findUser');
    });
});
