<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Purchase;

class ProductController extends Controller
{
    public function store(Request $request)
    {
    $request->validate([
        'name' => ['required', 'max:255'],
        'brand' => ['nullable', 'max:255'],
        'description' => ['required'],
        'price' => ['required', 'integer'],
        'condition' => ['required'],
        'image_url' => ['nullable', 'url'], 
    ]);

         $product = Product::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'brand' => $request->brand,
        'description' => $request->description,
        'price' => $request->price,
        'condition' => $request->condition,
        'image' => $request->image_url, 
    ]);

    if ($request->categories) {
    $categoryIds = [];

    foreach ($request->categories as $categoryName) {
        $category = Category::firstOrCreate(['name' => $categoryName]);
        $categoryIds[] = $category->id;
    }

    $product->categories()->sync($categoryIds);
    }

    return redirect()->route('mypage');
    }
    public function mypage()
    {
    $products = Product::with('purchase')->latest()->get();

    return view('mypage', compact('products'));
    }
    public function show($id)
    {
        $product = Product::with(['categories', 'comments.user', 'likes'])
        ->findOrFail($id);

        return view('product.show', compact('product'));
    }

    public function commentStore(Request $request, $id)
    {
    $request->validate([
        'content' => ['required', 'string', 'max:500'],
    ], [
        'content.required' => 'コメントを入力してください',
    ]);

    Comment::create([
        'user_id' => Auth::id(),
        'product_id' => $id,
        'content' => $request->content,
    ]);

    return redirect()->route('product.show', $id);
    }

    public function toggleLike($id)
    {
    $product = Product::findOrFail($id);

    $userId = Auth::id();

    // すでにいいねしてるか確認
    $like = Like::where('user_id', $userId)
        ->where('product_id', $id)   
        ->first();

    if ($like) {
        $like->delete(); 
    } else {
        Like::create([
            'user_id' => $userId,
            'product_id' => $id,     
        ]);
    }

    return back();
    }

    public function purchase($id)
    {
      $product = Product::findOrFail($id);

      $user = Auth::user();

      return view('product.purchase', compact('product', 'user'));
    }
    public function purchaseStore(Request $request, $id)
    {
    $request->validate([
        'payment_method' => 'required'
    ]);

    $product = Product::findOrFail($id);
    $user = Auth::user();

    Purchase::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'payment_method' => $request->payment_method,
        'zipcode' => $user->zipcode,
        'address' => $user->address,
        'building' => $user->building,
    ]);

    return redirect()->route('mypage')
    ->with('success', '購入が完了しました');
    }
}
