<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class SMSChannel
{
    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toSMS($notifiable);
        $number = $notifiable->mobile_number;


    }
}
