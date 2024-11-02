<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	use HasFactory;

	protected $fillable = ['name'];

	public function products()
	{
		return $this->belongsToMany(Product::class);
	}

	public function images()
	{
		return $this->belongsToMany(Image::class);
	}

	public function photos()
	{
		return $this->belongsToMany(Photo::class);
	}
}