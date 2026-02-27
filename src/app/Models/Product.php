<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // ← 追加

class Product extends Model
{
    use HasFactory;

    // 🔥 一括代入できるカラムを指定
    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'description',
        'price',
        'image',
        'condition',
    ];

    // 🔥 出品者とのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
       return $this->belongsToMany(Category::class);
    }
    
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }
    public function likedUsers()
    {
    return $this->belongsToMany(\App\Models\User::class, 'likes')->withTimestamps();
    }

    public function isLikedByAuthUser()
    {
        return $this->likes()
                    ->where('user_id', auth()->id())
                    ->exists();
    }
}

