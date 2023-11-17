<?php

namespace App\Channels;

use Exception;
use Illuminate\Notifications\Notification;
use Log;

class SMSChannel
{
    /**
     * Send the given notification.
     * @throws Exception
     */
    public function send(object $notifiable, Notification $notification): void
    {
        try {
            $message = $notification->toSMS($notifiable);
            $number = $notifiable->mobile_number;
            app($this->getProvider())->send($number, $message);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    private function getProvider(): string
    {
        $provider = config('sms.default');
        return config("sms.providers.$provider.driver");
    }
}
