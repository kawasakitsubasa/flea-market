<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand' => 'nullable|max:255',
            'description' => 'required',
            'price' => 'required|integer',
            'condition' => 'required',
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'condition' => $request->condition,
        ]);

        return redirect()->route('mypage');
    }
    public function mypage()
    {
        $products = Auth::user()->products()->latest()->get();

        return view('mypage', compact('products'));
    }

}
