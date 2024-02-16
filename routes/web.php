<?php

use App\Http\Controllers\PerbaikanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route untuk perbaikan
// Route::get('/perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
// Route::get('/perbaikan/{id}', [PerbaikanController::class, 'show'])->name('perbaikan.show');

Route::prefix('admin')->group(function () {
    Route::get('perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
    Route::get('perbaikan/{id}', [PerbaikanController::class, 'show'])->name('perbaikan.show');
});

Route::prefix('public')->group(function() {
    Route::get('/kontak', function () {
        echo 'Ini halaman kontak';
    });
});