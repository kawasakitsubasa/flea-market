<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Product; // ← 🔥 追加

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 🔥 ここを追加
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
    return $this->hasMany(\App\Models\Comment::class);
    }

    public function likes()
    {
    return $this->hasMany(\App\Models\Like::class);
    }

    public function likedProducts()
    {
    return $this->belongsToMany(\App\Models\Product::class, 'likes')->withTimestamps();
    }

    public function purchases()
    {
    return $this->hasMany(\App\Models\Purchase::class);
    }
}
