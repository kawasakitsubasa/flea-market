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

// 商品詳細（ログイン不要）
Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('product.show');

// ログイン
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');

// ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// 🔐 認証ユーザー専用
Route::middleware(['auth'])->group(function () {

    // マイページ
    Route::get('/mypage', [ProductController::class, 'mypage'])
        ->name('mypage');

    // プロフィール
    Route::get('/profile', function () {

    $user = auth()->user();

    $sellingProducts = $user->products;
    $purchasedProducts = $user->purchases()->with('product')->get();

    return view('profile', compact('sellingProducts', 'purchasedProducts'));

     })->name('profile');

    // プロフィール編集
    Route::get('/profile/setup', [ProfileController::class, 'setup'])->name('profile.setup');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // 出品
    Route::get('/sell', function () {
        return view('sell');
    })->name('sell');

    Route::post('/sell', [ProductController::class, 'store'])
        ->name('sell.store');

    // コメント投稿
    Route::post('/product/{id}/comment', [ProductController::class, 'commentStore'])
        ->name('product.comment.store');

    // ❤️ いいねトグル
    Route::post('/product/{id}/like', [ProductController::class, 'toggleLike'])
        ->name('product.like');

    // 🛒 購入画面
    Route::get('/product/{id}/purchase', [ProductController::class, 'purchase'])
        ->name('product.purchase');
    
    Route::post('/product/{id}/purchase', [ProductController::class, 'purchaseStore'])
    ->name('product.purchase.store');

        // 🏠 住所変更（購入用）
    Route::get('/purchase/address/edit', [ProfileController::class, 'editAddress'])
        ->name('purchase.address.edit');

    Route::put('/purchase/address/update', [ProfileController::class, 'updateAddress'])
        ->name('purchase.address.update');
});