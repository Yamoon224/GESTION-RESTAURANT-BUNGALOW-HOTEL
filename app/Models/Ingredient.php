<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $updated_by
 * @property int $deleted
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Ingredient extends Model
{
	use SoftDeletes;
	
	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_at' => 'datetime'
	];

	protected $guarded = [];

	public function products()
	{
		return $this->hasMany(Product::class);
	}

	public function updator()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function creator()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function product_details()
	{
		return $this->hasMany(ProductDetail::class);
	}
}
