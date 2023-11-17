<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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


Route::name('transaction.')->prefix('transaction')->group(function () {
    Route::post('/transfer', [TransactionController::class, 'transfer'])->name('transfer');
});

Route::name('user.')->prefix('user')->group(function () {
    Route::get('/top', [UserController::class, 'top'])->name('top');
});
