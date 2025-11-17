<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\BookingClass;
use App\Mail\ClassReminderMail;

class SendReminder extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Send email reminders 5 minutes before class starts';

    public function handle()
    {
        $now = Carbon::now();

        // Fetch accepted bookings where class starts in the next 5 minutes
        $upcomingBookings = BookingClass::with('liveClass')
            ->where('status', 'accepted') // ✅ Use correct column name
            ->whereNull('reminder_sent_at')
            ->get()
            ->filter(function ($booking) use ($now) {
                if (!$booking->liveClass) return false;

                $start = Carbon::parse($booking->liveClass->start_time);
                $diff = $start->diffInMinutes($now, false); // negative if in future
                return $diff <= 5 && $diff > 0; // 0 < minutes <= 5
            });

        if ($upcomingBookings->isEmpty()) {
            $this->info('No upcoming classes within 5 minutes.');
            return;
        }

        foreach ($upcomingBookings as $booking) {
            try {
                Mail::to($booking->student_email)->send(new ClassReminderMail($booking));

                // Mark reminder as sent
                $booking->update(['reminder_sent_at' => now()]);

                $this->info("Reminder sent to {$booking->student_email} for class at {$booking->liveClass->start_time}");
            } catch (\Exception $e) {
                $this->error("Failed to send email to {$booking->student_email}: " . $e->getMessage());
            }
        }

        $this->info('All reminders processed!');
    }
}
