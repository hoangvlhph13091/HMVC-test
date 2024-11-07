<?php
use Modules\Customer\Http\Controllers\CustomerController;

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
    Route::prefix('customer')->group(function() {
        Route::any('/', [CustomerController::class, 'index'])->name('customer');
        Route::get('/create', [CustomerController::class, 'createForm'])->name('customer.addForm');
        Route::post('/create', [CustomerController::class, 'create'])->name('customer.add');
        Route::get('/edit/{id}', [CustomerController::class, 'editForm'])->name('customer.editForm');
        Route::post('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::any('/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.del');
    });
});
