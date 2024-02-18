<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Mygoods extends Model
{
	use HasFactory;
	
	protected $fillable = [
		'name',
		'user_id'
		];

	public function user()
	{
		return $this->belongsto(User::class);
	}
}
