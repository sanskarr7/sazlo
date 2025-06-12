<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Define the relationship to Products
    public function products()
    {
        return $this->hasMany(Product::class, 'c_id');
    }
}