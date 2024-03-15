<?php

use App\Http\Controllers\AuthController;
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
    return view('auth.login');
});

// public
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('authlogin', [AuthController::class, 'authlogin'])->name('auth.authlogin');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

// Group Private
Route::group(['middleware' => ['auth']], function() {
    // Admin
    Route::group(['middleware' => ['cekakses:admin']], function () {
        //Route::get('perbaikan', [PerbaikanController::class, 'dashadmin']);
        Route::get('dashboard', [PerbaikanController::class, 'dashadmin'])->name('perbaikan.dashboard');
    });
    // Pegawai
    Route::group(['middleware' => ['cekakses:pegawai']], function () {
        //Route::get('perbaikan', [PerbaikanController::class, 'dashpegawai']);
        Route::get('dashboardpegawai', [PerbaikanController::class, 'dashpegawai'])->name('perbaikan.dashboardpegawai');
    });
});

// Route untuk perbaikan
Route::get('perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
Route::get('perbaikan/create', [PerbaikanController::class, 'create'])->name('perbaikan.create');
Route::post('perbaikan', [PerbaikanController::class, 'store'])->name('perbaikan.store');
Route::get('perbaikan/{id}', [PerbaikanController::class, 'show'])->name('perbaikan.show');
Route::get('perbaikan/{id}/edit', [PerbaikanController::class, 'edit'])->name('perbaikan.edit');
Route::put('perbaikan/{id}', [PerbaikanController::class, 'update'])->name('perbaikan.update');
Route::delete('perbaikan/{id}', [PerbaikanController::class, 'destroy'])->name('perbaikan.destroy');

// Route::get('eviden/{perbaikan_id}/upload', [EvidenController::class, 'index']);
// Route::delete('eviden/{perbaikan_id}', [EvidenController::class, 'destroy'])->name('eviden.destroy');

Route::prefix('admin')->group(function () {
    Route::get('perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
});

Route::prefix('public')->group(function() {
    Route::get('/kontak', function () {
        echo 'Ini halaman kontak';
    });
});