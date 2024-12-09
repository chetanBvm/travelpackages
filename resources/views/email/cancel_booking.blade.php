<!DOCTYPE html>
<html>
<head>
    <title>Booking Cancellation</title>
</head>
<body>
    <h1>Booking Cancellation Notification</h1>
    <p>Dear {{ $booking->passenger_name }},</p>

    <p>We regret to inform you that your booking has been canceled.</p>
    <p><strong>Reason:</strong> {{ $reason }}</p>

    <p>If you have any questions, please contact us.</p>

    <p>Thank you,<br>The {{ config('app.name') }} Team</p>
</body>
</html>
