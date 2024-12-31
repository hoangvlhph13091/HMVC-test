<?php

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

use Modules\Setting\Http\Controllers\SettingController;

Route::middleware('auth')->group(function () {
    Route::prefix('setting')->group(function() {
        Route::any('/', [SettingController::class, 'index'])->name('setting');
        Route::post('/saveImage', [SettingController::class, 'saveImage'])->name('setting.saveImage');
    });
});
