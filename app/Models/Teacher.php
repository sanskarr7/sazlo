<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'number',
        'course',
        'price',
        'description',
        'more_info',
        'live_link', // Add live_link here as it's also updated via mass assignment
        'picture', // Add live_link here as it's also updated via mass assignment
    ];

    public function liveClasses()
    {
        return $this->hasMany(LiveClass::class);
    }
}