<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'images',
        'price',
        'discount_price',
        'currency',
        'stock_quantity',
        'stock_status',
        'weight',
        'ingredients',
        'allergy_info',
        'storage_instructions',
        'brand',
    ];
    public function wishlistUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function cartUsers()
    {
        return $this->belongsToMany(User::class, 'carts');
    }
}
