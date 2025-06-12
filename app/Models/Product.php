<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'picture',
        'picture2',
        'description',
        'ex_description',
        'price',
        'quantity',
        'category',
        'type',
        'pdf',
        'video',
        'video2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'name');
    }
}
