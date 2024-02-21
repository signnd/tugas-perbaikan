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
Route::get('perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
Route::get('perbaikan/create', [PerbaikanController::class, 'create'])->name('perbaikan.create');
Route::post('perbaikan', [PerbaikanController::class, 'store'])->name('perbaikan.store');
Route::get('perbaikan/{id}', [PerbaikanController::class, 'show'])->name('perbaikan.show');
Route::get('perbaikan/{id}/edit', [PerbaikanController::class, 'edit'])->name('perbaikan.edit');
Route::put('perbaikan/{id}', [PerbaikanController::class, 'update'])->name('perbaikan.update');
Route::delete('perbaikan/{id}', [PerbaikanController::class, 'destroy'])->name('perbaikan.destroy');

Route::prefix('admin')->group(function () {
    Route::get('perbaikan', [PerbaikanController::class, 'index'])->name('admin.perbaikan.index');
    //Route::get('perbaikan/{id}', [PerbaikanController::class, 'show'])->name('perbaikan.show');
});

Route::prefix('public')->group(function() {
    Route::get('/kontak', function () {
        echo 'Ini halaman kontak';
    });
});