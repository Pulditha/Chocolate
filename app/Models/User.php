<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Added 'role' to make it mass assignable
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $dates = ['last_login_at'];

    public function updateLastLogin()
    {
        $this->last_login_at = now();
        $this->save();
    }

    public function wishlist()
{
    return $this->hasMany(Wishlist::class);
}

public function cart()
{
    return $this->hasMany(Cart::class, 'user_id');
}

public function cartItems()
{
    return $this->hasMany(Cart::class);
}

}