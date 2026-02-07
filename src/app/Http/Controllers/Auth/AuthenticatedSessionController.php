<?php

// app/Http/Controllers/Auth/AuthenticatedSessionController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if (!$user->is_profile_set) {
                return redirect()->route('profile.edit'); // プロフィール設定画面へ
            }

            return redirect()->intended('/mypage'); // 通常遷移先
        }

        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません',
        ]);
    }
    public function destroy(Request $request)
    {
       Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); 
    }

}

