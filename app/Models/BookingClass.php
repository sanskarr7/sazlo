<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingClass extends Model
{
    use HasFactory;

    protected $table = 'booking_classes'; // Explicitly define table name
protected $dates = ['start_time', 'reminder_sent_at'];

    protected $fillable = [
        'live_class_id',
        'user_id',
        'student_name',
        'student_email',
        'booking_date',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
    ];

    public function liveClass()
    {
        return $this->belongsTo(LiveClass::class, 'live_class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
