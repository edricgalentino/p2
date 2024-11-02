<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    // protected $fillable = ['product_id', 'url'];
    protected $guarded = []; // Allow mass assignment for all attributes

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, "photo_tags");
    }
}
