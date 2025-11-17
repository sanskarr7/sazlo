<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BookingClass;

class ClassReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(BookingClass $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Your class is starting soon')
                    ->markdown('emails.class_reminder')
                    ->with([
                        'student_name' => $this->booking->student_name,
                        'class_title' => $this->booking->liveClass->title,
                        'start_time' => $this->booking->liveClass->start_time,
                        'link' => $this->booking->liveClass->link,
                    ]);
    }
}
