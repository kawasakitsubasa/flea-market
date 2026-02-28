<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'payment_method',
        'zipcode',
        'address',
        'building',
    ];

    public function product()
    {
      return $this->belongsTo(\App\Models\Product::class);
    }
}
