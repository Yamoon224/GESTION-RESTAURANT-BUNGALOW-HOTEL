<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function group()
	{
		return $this->belongsTo(Group::class);
	}

	public function categories_creator()
	{
		return $this->hasMany(Category::class, 'created_by');
	}

	public function products_creator()
	{
		return $this->hasMany(Product::class, 'created_by');
	}

	public function order_details_creator()
	{
		return $this->hasMany(OrderDetail::class, 'created_by');
	}

	public function orders_creator()
	{
		return $this->hasMany(Order::class, 'created_by');
	}

	public function categories_updator()
	{
		return $this->hasMany(Category::class, 'updated_by');
	}

	public function products_updator()
	{
		return $this->hasMany(Product::class, 'updated_by');
	}

	public function order_details_updator()
	{
		return $this->hasMany(OrderDetail::class, 'updated_by');
	}

	public function orders_updator()
	{
		return $this->hasMany(Order::class, 'updated_by');
	}
}
