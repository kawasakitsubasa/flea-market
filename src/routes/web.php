<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

// トップページ
Route::get('/', function () {
    return view('welcome');
});

// ログイン
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');

// ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// 認証済みユーザー専用
Route::middleware(['auth'])->group(function () {

    Route::get('/mypage', [ProductController::class, 'mypage'])
        ->name('mypage');

    Route::get('/profile', function () {
    $products = Product::latest()->get(); // まずはダミー全件表示
    return view('profile', compact('products'));
    })->name('profile');

    Route::get('/profile/setup', [ProfileController::class, 'setup'])->name('profile.setup');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/sell', function () {
        return view('sell');
    })->name('sell');

    Route::post('/sell', [ProductController::class, 'store'])
        ->name('sell.store');
});

