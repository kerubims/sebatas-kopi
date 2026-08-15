<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    /**
     * Get all products for this category
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
