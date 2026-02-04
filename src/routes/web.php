<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // ←① 追加

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップページ（仮）
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ログイン処理（FortifyのログインPOSTを上書き）
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login'); // ←② ここに追加（middlewareの外）

// ------------------------------
// 認証後ユーザー専用
// ------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile/setup', [ProfileController::class, 'setup'])->name('profile.setup');

    // プロフィール設定画面（初回ログイン後）
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // プロフィール更新処理
    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');
});
