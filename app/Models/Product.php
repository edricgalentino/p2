<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	protected $fillable = ['name', 'description', 'price', 'image', 'stock', 'year', 'condition'];

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'tags_products');
	}

	public function images()
	{
		return $this->belongsToMany(Image::class);
	}

	public function photos()
	{
		return $this->hasMany(Photo::class, 'product_id', 'id');
	}
}