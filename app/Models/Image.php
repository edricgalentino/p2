<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model

{

	use HasFactory;

	protected $fillable = ['name', 'path', 'description'];

	public function products()

	{

		return $this->belongsToMany(Product::class);
	}

	public function tags()

	{

		return $this->belongsToMany(Tag::class);
	}
}