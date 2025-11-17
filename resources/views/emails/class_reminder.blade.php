<!DOCTYPE html>
<html>
<head>
    <title>Class Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            background-color: #fff;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .header h2 {
            margin: 0;
            color: #007bff;
        }
        .content {
            padding: 20px 0;
        }
        .content p {
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff !important;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Class Reminder</h2>
        </div>
        <div class="content">
            <p>Hello <strong>{{ $booking->student_name }}</strong>,</p>
            <p>This is a friendly reminder for your upcoming class:</p>
            <p>
                <strong>Title:</strong> {{ $booking->liveClass->title }}<br>
                <strong>Start Time:</strong> {{ \Carbon\Carbon::parse($booking->liveClass->start_time)->format('d M Y, h:i A') }}
            </p>
            <p>You can join your class using the link below:</p>
            <p style="text-align:center;">
                <a href="{{ $booking->liveClass->link }}" class="btn" target="_blank">Join Class</a>
            </p>
            <p>Please make sure to join on time. We look forward to seeing you!</p>
            <p>Thank you,<br>Sazlo Online Course</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Sanskar Satyal. All rights reserved.
        </div>
    </div>
</body>
</html>
