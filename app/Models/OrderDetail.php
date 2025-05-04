<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderDetail
 * 
 * @property int $id
 * @property float $qty
 * @property float $price
 * @property float $amount
 * @property int $dish_id
 * @property int $order_id
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $updated_by
 * @property int $deleted
 * 
 * @property User $user
 * @property Dish $dish
 * @property Order $order
 *
 * @package App\Models
 */
class OrderDetail extends Model
{
	use SoftDeletes;
	
	protected $casts = [
		'qty' => 'float',
		'price' => 'float',
		'amount' => 'float',
		'dish_id' => 'int',
		'order_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_at' => 'datetime'
	];

	protected $guarded = [];

	public function creator()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function updator()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
