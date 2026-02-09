<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // 今はDB保存は省略し、マイページへリダイレクト
        return redirect()->route('mypage');
    }
}