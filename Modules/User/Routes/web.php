<?php
use Modules\User\Http\Controllers\UserController;
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
    Route::prefix('user')->group(function() {
        Route::any('/', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'createForm'])->name('user.addForm');
        Route::post('/create', [UserController::class, 'create'])->name('user.add');
        Route::get('/edit/{id}', [UserController::class, 'editForm'])->name('user.editForm');
        Route::post('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::any('/delete/{id}', [UserController::class, 'destroy'])->name('user.del');
    });
});

