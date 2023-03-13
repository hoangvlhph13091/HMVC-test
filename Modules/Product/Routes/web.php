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
    Route::patch('/', [ProductController::class, 'delRes'])->name('delRes');
    Route::get('/trashed', [ProductController::class, 'trashedItem'])->name('productTrashed');
    Route::patch('/trashed', [ProductController::class, 'delRes'])->name('productTrashed');
    Route::get('/create', [ProductController::class, 'create'])->name('createProduct');
});
