<?php

use App\Http\Controllers\Api\PerbaikanController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/welcome', function () {
    dd('welcome');
});

Route::get('perbaikan', [PerbaikanController::class, 'index'])->middleware(['auth:sanctum'])->name('api.perbaikan.index');
Route::post('perbaikan', [PerbaikanController::class, 'store'])->name('api.perbaikan.store');
Route::post('login', [AuthController::class, 'authlogin'])->name('api.auth.authlogin');
Route::get('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum'])->name('api.auth.logout');

// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);
//     return ['token' => $token->plainTextToken];
// });