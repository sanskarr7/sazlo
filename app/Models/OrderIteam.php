<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIteam extends Model
{
   protected $table = 'order_iteams'; // Your existing table name

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID'); // Match your foreign key
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID');
    }
}   
