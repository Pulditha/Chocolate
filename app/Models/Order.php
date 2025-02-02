<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'address', 'total_amount', 'payment_status', 'stripe_payment_id'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
