<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * プロフィール設定画面表示
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * プロフィール更新処理
     */
    public function update(Request $request)
    {
    $request->validate([
        'name'     => ['required', 'string', 'max:20'],
        'zipcode'  => ['nullable', 'string', 'max:10'],
        'address'  => ['nullable', 'string', 'max:255'],
        'building' => ['nullable', 'string', 'max:255'],
        'avatar'   => ['nullable', 'image', 'max:2048'],
    ]);

    $user = Auth::user();

    // 画像アップロード（あれば）
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
    }

    $user->name     = $request->name;
    $user->zipcode  = $request->zipcode;
    $user->address  = $request->address;
    $user->building = $request->building;

    // ⭐ 初回プロフィール設定完了フラグ
    $user->is_profile_set = true;

    $user->save();

    return redirect()
        ->route('profile.edit')
        ->with('status', 'プロフィールを更新しました');
    }

    public function setup()
    {
    $user = Auth::user();

    return view('profile.edit', compact('user'));
    }


}
