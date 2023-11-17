<?php

namespace App\Notifications;

use App\Channels\SMSChannel;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ReceivedTransaction extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly Transaction $transaction
    ) {
    }

    public function via(): string
    {
        return SMSChannel::class;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSMS(object $notifiable): array
    {
        return `You have received a new transaction`;
    }

}
