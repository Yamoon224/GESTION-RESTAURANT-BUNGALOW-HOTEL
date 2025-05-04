<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * 
 * @property int $id
 * @property string $ref
 * @property float $amount
 * @property string|null $description
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $updated_by
 * @property int $deleted
 * 
 * @property User $user
 * @property Collection|OrderDetail[] $order_details
 *
 * @package App\Models
 */
class Order extends Model
{
	use SoftDeletes;
	
	protected $casts = [
		'amount' => 'float',
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

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class);
	}
}
