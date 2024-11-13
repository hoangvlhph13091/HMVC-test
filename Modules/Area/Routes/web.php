<?php
use Modules\Area\Http\Controllers\AreaController;
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
    Route::prefix('area')->group(function() {
        Route::any('/', [AreaController::class, 'index'])->name('area');
        Route::get('/create', [AreaController::class, 'createForm'])->name('area.addForm');
        Route::post('/create', [AreaController::class, 'create'])->name('area.add');
        Route::get('/edit/{id}', [AreaController::class, 'editForm'])->name('area.editForm');
        Route::post('/edit/{id}', [AreaController::class, 'edit'])->name('area.edit');
        Route::any('/delete/{id}', [AreaController::class, 'destroy'])->name('area.del');
    });
});
