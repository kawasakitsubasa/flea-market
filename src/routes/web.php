<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// トップページ（仮）
Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
// 認証済みユーザー専用
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile/setup', [ProfileController::class, 'setup'])->name('profile.setup');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/mypage', function () {
        return view('mypage');
    })->name('mypage');
});
