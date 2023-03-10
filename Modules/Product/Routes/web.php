<?php
use Modules\Product\Http\Controllers\ProductController;

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

Route::prefix('product')->group(function() {
    Route::any('/', [ProductController::class, 'index'])->name('product');
    Route::any('/delete/{id}', [ProductController::class, 'del'])->name('delete');
    Route::any('/restore/{id}', [ProductController::class, 'res'])->name('delete');
});
