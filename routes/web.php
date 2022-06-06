<?php

use Illuminate\Support\Facades\Route;

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
Route::group([
    'prefix' => 'api',
], function () {
    Route::post('quotation', [App\Http\Controllers\DashboardController::class , 'getValutes'])->middleware(['auth'])->name('quotation');
    Route::get('regenerate', [App\Http\Controllers\DashboardController::class , 'regenerateToken'])->middleware(['auth'])->name('regenerate');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
