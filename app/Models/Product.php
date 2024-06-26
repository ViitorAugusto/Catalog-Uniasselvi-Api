<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'price', 'image', 'description', 'moreDetails', 'category', 'featured',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}


